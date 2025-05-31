@extends("layouts.app")

@section("title", "Lab Manager Dashboard")

@section("content")
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Lab Manager Dashboard - {{ $lab->name }}</h1>

    <div class="row">
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
    </div>

    <div class="row">
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

    <!-- Recent Samples -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Samples</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Sample ID</th>
                                    <th>Client</th>
                                    <th>Type</th>
                                    <th>Received Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentSamples as $sample)
                                    <tr>
                                        <td><a href="{{ route("samples.show", $sample) }}">{{ $sample->sample_id }}</a></td>
                                        <td>{{ $sample->client_name }}</td>
                                        <td>{{ Str::title(str_replace("_", " ", $sample->sample_type)) }}</td>
                                        <td>{{ $sample->received_date->format("Y-m-d") }}</td>
                                        <td><span class="{{ $sample->status_badge }}">{{ Str::title(str_replace("_", " ", $sample->status)) }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No recent samples found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

