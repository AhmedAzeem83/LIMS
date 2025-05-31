<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sample;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiTestController extends Controller
{
    public function index()
    {
        $tests = Test::with(['sample', 'device', 'assignedUser'])->get();
        return response()->json($tests);
    }

    public function show($id)
    {
        $test = Test::with(['sample', 'device', 'assignedUser', 'approver'])->findOrFail($id);
        return response()->json($test);
    }

    public function submitResults(Request $request, $id)
    {
        $test = Test::findOrFail($id);
        
        if ($test->status !== 'in_progress') {
            return response()->json(['error' => 'Test is not in progress'], 422);
        }
        
        $validator = Validator::make($request->all(), [
            'results' => 'required|array',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $test->update([
            'status' => 'completed',
            'completed_at' => now(),
            'results' => $request->results,
            'notes' => $request->notes,
        ]);
        
        return response()->json($test);
    }
}
