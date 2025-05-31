<?php

namespace App\Http\Controllers;

use App\Http\Requests\LabRequest;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:view labs')->only(['index', 'show']);
        $this->middleware('permission:manage labs')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $labs = Lab::all();
        return view('labs.index', compact('labs'));
    }

    public function create()
    {
        return view('labs.create');
    }

    public function store(LabRequest $request)
    {
        $lab = Lab::create($request->validated());
        return redirect()->route('labs.index')->with('success', 'Lab created successfully.');
    }

    public function show(Lab $lab)
    {
        return view('labs.show', compact('lab'));
    }

    public function edit(Lab $lab)
    {
        return view('labs.edit', compact('lab'));
    }

    public function update(LabRequest $request, Lab $lab)
    {
        $lab->update($request->validated());
        return redirect()->route('labs.index')->with('success', 'Lab updated successfully.');
    }

    public function destroy(Lab $lab)
    {
        $lab->delete();
        return redirect()->route('labs.index')->with('success', 'Lab deleted successfully.');
    }
}
