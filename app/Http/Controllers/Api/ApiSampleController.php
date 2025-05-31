<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiSampleController extends Controller
{
    public function index()
    {
        $samples = Sample::with(['lab', 'creator'])->get();
        return response()->json($samples);
    }

    public function show($id)
    {
        $sample = Sample::with(['lab', 'creator', 'tests'])->findOrFail($id);
        return response()->json($sample);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'client_name' => 'required|string|max:255',
            'sample_type' => 'required|in:crude_oil,natural_gas,lpg,glycol,lubricating_oil,water,other',
            'collection_date' => 'required|date',
            'received_date' => 'required|date|after_or_equal:collection_date',
            'notes' => 'nullable|string',
            'lab_id' => 'required|exists:labs,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $validator->validated();
        $data['created_by'] = $request->user()->id;
        $data['sample_id'] = 'S-' . date('Ymd') . '-' . Str::random(5);
        $data['status'] = 'pending';
        
        $sample = Sample::create($data);
        
        return response()->json($sample, 201);
    }
}
