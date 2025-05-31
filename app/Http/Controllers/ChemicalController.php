<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChemicalRequest;
use App\Models\Chemical;
use App\Models\Lab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChemicalController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view chemicals')->only(['index', 'show']);
        $this->middleware('permission:manage chemicals')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $chemicals = Chemical::with('lab')->get();
        return view('chemicals.index', compact('chemicals'));
    }

    public function create()
    {
        $labs = Lab::all();
        return view('chemicals.create', compact('labs'));
    }

    public function store(ChemicalRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('msds_file')) {
            $path = $request->file('msds_file')->store('msds', 'public');
            $data['msds_file'] = $path;
        }
        
        $chemical = Chemical::create($data);
        return redirect()->route('chemicals.index')->with('success', 'Chemical created successfully.');
    }

    public function show(Chemical $chemical)
    {
        return view('chemicals.show', compact('chemical'));
    }

    public function edit(Chemical $chemical)
    {
        $labs = Lab::all();
        return view('chemicals.edit', compact('chemical', 'labs'));
    }

    public function update(ChemicalRequest $request, Chemical $chemical)
    {
        $data = $request->validated();
        
        if ($request->hasFile('msds_file')) {
            if ($chemical->msds_file) {
                Storage::disk('public')->delete($chemical->msds_file);
            }
            $path = $request->file('msds_file')->store('msds', 'public');
            $data['msds_file'] = $path;
        }
        
        $chemical->update($data);
        return redirect()->route('chemicals.index')->with('success', 'Chemical updated successfully.');
    }

    public function destroy(Chemical $chemical)
    {
        if ($chemical->msds_file) {
            Storage::disk('public')->delete($chemical->msds_file);
        }
        
        $chemical->delete();
        return redirect()->route('chemicals.index')->with('success', 'Chemical deleted successfully.');
    }
}
