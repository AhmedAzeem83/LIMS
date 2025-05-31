@extends("layouts.app")

@section("title", "Admin Dashboard")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Admin Dashboard</h1>

    <div class="row">
        <!-- Total Labs -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Labs</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLabs }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-building fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Devices -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Devices</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDevices }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-tools fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Samples -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Samples
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalSamples }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-droplet fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Total Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Pending Tests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Tests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingTests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-hourglass-split fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Tests -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Completed Tests</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $completedTests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check2-circle fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Devices Needing Calibration -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                Calibration Due (7 days)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $devicesNeedingCalibration }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-calendar-week fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Chemicals -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Low Stock Chemicals</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $lowStockChemicals }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-exclamation-triangle fs-2 text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <a href="{{ route("labs.create") }}" class="btn btn-primary btn-sm me-2">Add New Lab</a>
                    <a href="{{ route("devices.create") }}" class="btn btn-success btn-sm me-2">Add New Device</a>
                    <a href="{{ route("chemicals.create") }}" class="btn btn-info btn-sm me-2">Add New Chemical</a>
                    <a href="{{ route("samples.create") }}" class="btn btn-warning btn-sm me-2">Add New Sample</a>
                    <a href="{{ route("users.create") }}" class="btn btn-secondary btn-sm">Add New User</a>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

