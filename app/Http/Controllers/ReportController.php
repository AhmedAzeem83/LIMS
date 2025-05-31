<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportRequest;
use App\Models\Report;
use App\Models\Test;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view reports')->only(['index', 'show', 'download']);
        $this->middleware('permission:generate reports')->only(['create', 'store', 'destroy']);
    }

    public function index()
    {
        $reports = Report::with(['test', 'generator'])->get();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        $tests = Test::where('status', 'approved')->get();
        return view('reports.create', compact('tests'));
    }

    public function store(ReportRequest $request)
    {
        $data = $request->validated();
        $test = Test::findOrFail($data['test_id']);
        
        // Generate report number
        $data['report_number'] = 'R-' . date('Ymd') . '-' . Str::random(5);
        $data['generated_by'] = Auth::id();
        $data['generated_at'] = now();
        
        // Generate PDF
        $pdf = PDF::loadView('reports.templates.test_report', [
            'test' => $test,
            'report_number' => $data['report_number'],
            'title' => $data['title'],
            'generated_at' => $data['generated_at'],
            'user' => Auth::user(),
        ]);
        
        // Save PDF to storage
        $filename = 'reports/' . $data['report_number'] . '.pdf';
        Storage::disk('public')->put($filename, $pdf->output());
        $data['file_path'] = $filename;
        
        $report = Report::create($data);
        
        return redirect()->route('reports.show', $report)->with('success', 'Report generated successfully.');
    }

    public function show(Report $report)
    {
        $report->load(['test', 'generator']);
        return view('reports.show', compact('report'));
    }

    public function download(Report $report)
    {
        return Storage::disk('public')->download($report->file_path, $report->report_number . '.pdf');
    }

    public function destroy(Report $report)
    {
        Storage::disk('public')->delete($report->file_path);
        $report->delete();
        
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
