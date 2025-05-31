@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between rounded-top-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-person-circle fs-2 me-3"></i>
                        <span class="fs-4 fw-bold">Admin Dashboard</span>
                    </div>
                    <span class="badge bg-light text-primary fs-6">{{ Auth::user()->name }}</span>
                </div>
                <div class="card-body bg-light rounded-bottom-4">
                    <h4 class="mb-3">Welcome, <span class="text-primary">{{ Auth::user()->name }}</span> <small class="text-muted">(Admin)</small>!</h4>
                    <p class="mb-4">You have full access to manage the Laboratory Information Management System.</p>
                    <div class="row g-4">
                        <div class="col-6 col-md-3">
                            <a href="{{ route('users.index') }}" class="dashboard-action-card">
                                <div class="action-icon bg-gradient-primary"><i class="bi bi-people fs-1"></i></div>
                                <div class="action-label">Manage Users</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('chemicals.index') }}" class="dashboard-action-card">
                                <div class="action-icon bg-gradient-success"><i class="bi bi-flask fs-1"></i></div>
                                <div class="action-label">Manage Chemicals</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('devices.index') }}" class="dashboard-action-card">
                                <div class="action-icon bg-gradient-warning"><i class="bi bi-cpu fs-1"></i></div>
                                <div class="action-label">Manage Devices</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('labs.index') }}" class="dashboard-action-card">
                                <div class="action-icon bg-gradient-info"><i class="bi bi-building fs-1"></i></div>
                                <div class="action-label">Manage Labs</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('samples.index') }}" class="dashboard-action-card">
                                <div class="action-icon bg-gradient-secondary"><i class="bi bi-droplet-half fs-1"></i></div>
                                <div class="action-label">Manage Samples</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('tests.index') }}" class="dashboard-action-card">
                                <div class="action-icon bg-gradient-danger"><i class="bi bi-clipboard-data fs-1"></i></div>
                                <div class="action-label">Manage Tests</div>
                            </a>
                        </div>
                        <div class="col-6 col-md-3">
                            <a href="{{ route('reports.index') }}" class="dashboard-action-card">
                                <div class="action-icon bg-gradient-dark"><i class="bi bi-file-earmark-bar-graph fs-1"></i></div>
                                <div class="action-label">Manage Reports</div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom styles for dashboard -->
@push('styles')
<style>
.dashboard-action-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: #fff;
    border-radius: 1rem;
    box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    padding: 2rem 1rem 1rem 1rem;
    text-decoration: none;
    color: #333;
    transition: box-shadow 0.2s, transform 0.2s;
    min-height: 180px;
}
.dashboard-action-card:hover {
    box-shadow: 0 6px 24px rgba(0,0,0,0.15);
    transform: translateY(-4px) scale(1.03);
    color: #0d6efd;
}
.action-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    margin-bottom: 1rem;
    color: #fff;
    font-size: 2rem;
}
.bg-gradient-primary { background: linear-gradient(135deg, #0d6efd 60%, #6ea8fe 100%); }
.bg-gradient-success { background: linear-gradient(135deg, #198754 60%, #71dd8a 100%); }
.bg-gradient-warning { background: linear-gradient(135deg, #ffc107 60%, #ffe082 100%); }
.bg-gradient-info { background: linear-gradient(135deg, #0dcaf0 60%, #6fe7f7 100%); }
.bg-gradient-secondary { background: linear-gradient(135deg, #6c757d 60%, #bfc9d1 100%); }
.bg-gradient-danger { background: linear-gradient(135deg, #dc3545 60%, #ffb3b3 100%); }
.bg-gradient-dark { background: linear-gradient(135deg, #212529 60%, #495057 100%); }
.action-label {
    font-size: 1.1rem;
    font-weight: 500;
    text-align: center;
}
</style>
@endpush
@endsection

<!-- Bootstrap Icons CDN -->
@push('head')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush
