<?php

namespace App\Http\Controllers;

use App\Models\Calibration;
use App\Models\Chemical;
use App\Models\Device;
use App\Models\Lab;
use App\Models\Sample;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return $this->adminDashboard();
        if ($user->isAdmin()) {
            return $this->adminDashboard();
        } elseif ($user->isLabManager()) {
            return $this->labManagerDashboard();
        } elseif ($user->isChemistSupervisor()) {
            return $this->chemistSupervisorDashboard();
        } else {
            return $this->labTechnicianDashboard();
        }
    }

    private function adminDashboard()
    {
        $totalLabs = Lab::count();
        $totalDevices = Device::count();
        $totalSamples = Sample::count();
        $totalUsers = User::count();
        $pendingTests = Test::where('status', 'pending')->count();
        $completedTests = Test::where('status', 'completed')->count();
        $devicesNeedingCalibration = Device::whereDate('next_calibration_date', '<=', now()->addDays(7))->count();
        $lowStockChemicals = Chemical::whereRaw('quantity < 10')->count();
       
        return view('dashboard.admin', compact(
            'totalLabs',
            'totalDevices',
            'totalSamples',
            'totalUsers',
            'pendingTests',
            'completedTests',
            'devicesNeedingCalibration',
            'lowStockChemicals'
        ));
    }

    private function labManagerDashboard()
    {
        $user = Auth::user();
        $lab = $user->lab;
        
        $totalDevices = Device::where('lab_id', $lab->id)->count();
        $totalSamples = Sample::where('lab_id', $lab->id)->count();
        $pendingTests = Test::where('lab_id', $lab->id)->where('status', 'pending')->count();
        $completedTests = Test::where('lab_id', $lab->id)->where('status', 'completed')->count();
        $devicesNeedingCalibration = Device::where('lab_id', $lab->id)
            ->whereDate('next_calibration_date', '<=', now()->addDays(7))
            ->count();
        $lowStockChemicals = Chemical::where('lab_id', $lab->id)
            ->whereRaw('quantity < 10')
            ->count();
        $recentSamples = Sample::where('lab_id', $lab->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.lab_manager', compact(
            'lab',
            'totalDevices',
            'totalSamples',
            'pendingTests',
            'completedTests',
            'devicesNeedingCalibration',
            'lowStockChemicals',
            'recentSamples'
        ));
    }

    private function chemistSupervisorDashboard()
    {
        $user = Auth::user();
        $lab = $user->lab;
        
        $pendingTests = Test::where('lab_id', $lab->id)
            ->where('status', 'pending')
            ->count();
        $inProgressTests = Test::where('lab_id', $lab->id)
            ->where('status', 'in_progress')
            ->count();
        $completedTests = Test::where('lab_id', $lab->id)
            ->where('status', 'completed')
            ->count();
        $testsNeedingApproval = Test::where('lab_id', $lab->id)
            ->where('status', 'completed')
            ->whereNull('approved_by')
            ->count();
        $recentTests = Test::where('lab_id', $lab->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.chemist_supervisor', compact(
            'lab',
            'pendingTests',
            'inProgressTests',
            'completedTests',
            'testsNeedingApproval',
            'recentTests'
        ));
    }

    private function labTechnicianDashboard()
    {
        $user = Auth::user();
        $lab = $user->lab;
        
        $assignedTests = Test::where('assigned_to', $user->id)
            ->where('status', '!=', 'approved')
            ->where('status', '!=', 'rejected')
            ->count();
        $completedTests = Test::where('assigned_to', $user->id)
            ->where('status', 'completed')
            ->count();
        $recentAssignedTests = Test::where('assigned_to', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('dashboard.lab_technician', compact(
            'lab',
            'assignedTests',
            'completedTests',
            'recentAssignedTests'
        ));
    }
}
