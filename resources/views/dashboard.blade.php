@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header bg-primary text-white d-flex align-items-center justify-content-between rounded-top-4">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-droplet-half fs-2 me-3"></i>
                        <span class="fs-4 fw-bold">
                            {{ __(ucfirst(Auth::user()->role ?? 'Admin')) }} {{ __('Dashboard') }}
                        </span>
                    </div>
                    <span class="badge bg-light text-primary fs-6">{{ Auth::user()->name }}</span>
                </div>
                <div class="card-body bg-light rounded-bottom-4">
                    <h4 class="mb-3">
                        {{ __('Welcome') }}, <span class="text-primary">{{ Auth::user()->name }}</span>
                        <small class="text-muted">
                            ({{ __(ucfirst(Auth::user()->role ?? 'Admin')) }})
                        </small>!
                    </h4>
                    <p class="mb-4">{{ __('Manage all your Oil & Gas laboratory operations from one modern, interactive dashboard.') }}</p>
                    <div class="row g-4 justify-content-center">
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('users.index') }}" class="dashboard-action-card interactive-card" aria-label="{{ __('Manage Users') }}">
                                <div class="action-icon bg-gradient-primary"><i class="bi bi-people fs-1"></i></div>
                                <div class="action-label">{{ __('Manage Users') }}</div>
                            </a>
                            <a href="{{ route('users.create') }}" class="btn btn-sm btn-outline-primary w-100 mt-2 interactive-btn" aria-label="{{ __('Add User') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('chemicals.index') }}" class="dashboard-action-card interactive-card" aria-label="{{ __('Manage Chemicals') }}">
                                <div class="action-icon bg-gradient-success"><i class="bi bi-flask fs-1"></i></div>
                                <div class="action-label">{{ __('Manage Chemicals') }}</div>
                            </a>
                            <a href="{{ route('chemicals.create') }}" class="btn btn-sm btn-outline-success w-100 mt-2 interactive-btn" aria-label="{{ __('Add Chemical') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('devices.index') }}" class="dashboard-action-card interactive-card" aria-label="{{ __('Manage Devices') }}">
                                <div class="action-icon bg-gradient-warning"><i class="bi bi-cpu fs-1"></i></div>
                                <div class="action-label">{{ __('Manage Devices') }}</div>
                            </a>
                            <a href="{{ route('devices.create') }}" class="btn btn-sm btn-outline-warning w-100 mt-2 interactive-btn" aria-label="{{ __('Add Device') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('labs.index') }}" class="dashboard-action-card interactive-card" aria-label="{{ __('Manage Labs') }}">
                                <div class="action-icon bg-gradient-info"><i class="bi bi-building fs-1"></i></div>
                                <div class="action-label">{{ __('Manage Labs') }}</div>
                            </a>
                            <a href="{{ route('labs.create') }}" class="btn btn-sm btn-outline-info w-100 mt-2 interactive-btn" aria-label="{{ __('Add Lab') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('samples.index') }}" class="dashboard-action-card interactive-card" aria-label="{{ __('Manage Samples') }}">
                                <div class="action-icon bg-gradient-secondary"><i class="bi bi-droplet-half fs-1"></i></div>
                                <div class="action-label">{{ __('Manage Samples') }}</div>
                            </a>
                            <a href="{{ route('samples.create') }}" class="btn btn-sm btn-outline-secondary w-100 mt-2 interactive-btn" aria-label="{{ __('Add Sample') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('tests.index') }}" class="dashboard-action-card interactive-card" aria-label="{{ __('Manage Tests') }}">
                                <div class="action-icon bg-gradient-danger"><i class="bi bi-clipboard-data fs-1"></i></div>
                                <div class="action-label">{{ __('Manage Tests') }}</div>
                            </a>
                            <a href="{{ route('tests.create') }}" class="btn btn-sm btn-outline-danger w-100 mt-2 interactive-btn" aria-label="{{ __('Add Test') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                            </a>
                        </div>
                        <div class="col-6 col-sm-4 col-md-3">
                            <a href="{{ route('reports.index') }}" class="dashboard-action-card interactive-card" aria-label="{{ __('Manage Reports') }}">
                                <div class="action-icon bg-gradient-dark"><i class="bi bi-file-earmark-bar-graph fs-1"></i></div>
                                <div class="action-label">{{ __('Manage Reports') }}</div>
                            </a>
                            <a href="{{ route('reports.create') }}" class="btn btn-sm btn-outline-dark w-100 mt-2 interactive-btn" aria-label="{{ __('Add Report') }}">
                                <i class="bi bi-plus-circle"></i> {{ __('Add') }}
                            </a>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-12 text-center">
                            <div class="dashboard-info-card p-4 rounded-4 shadow-sm bg-white d-inline-block">
                                <i class="bi bi-info-circle text-primary fs-3 mb-2"></i>
                                <div class="fw-bold mb-1" style="font-size:1.2rem;">Oil & Gas Laboratory Information Management System</div>
                                <div class="text-muted" style="font-size:0.98rem;">
                                    Secure, modern, and interactive platform for managing all your laboratory data and operations.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
<style>
    .dashboard-action-card {
        display: block;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 4px 18px rgba(0,0,0,0.07);
        padding: 1.5rem 1rem 1rem 1rem;
        text-align: center;
        transition: box-shadow 0.2s, transform 0.2s, background 0.2s;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        min-height: 140px;
    }
    .dashboard-action-card .action-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 56px;
        height: 56px;
        margin: 0 auto 0.7rem auto;
        border-radius: 50%;
        font-size: 2rem;
        transition: background 0.2s, color 0.2s, transform 0.2s;
    }
    .dashboard-action-card .action-label {
        font-weight: 600;
        color: #003366;
        font-size: 1.08rem;
        margin-top: 0.2rem;
        letter-spacing: 0.5px;
    }
    .dashboard-action-card:hover, .dashboard-action-card:focus {
        box-shadow: 0 8px 32px rgba(0,51,102,0.13);
        background: #e0e7ef;
        transform: translateY(-3px) scale(1.03);
        text-decoration: none;
    }
    .dashboard-action-card:hover .action-icon,
    .dashboard-action-card:focus .action-icon {
        transform: scale(1.15) rotate(-8deg);
        filter: brightness(1.2);
    }
    .interactive-btn {
        transition: background 0.2s, color 0.2s, transform 0.2s;
        font-weight: 600;
        border-radius: 2rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .interactive-btn:hover, .interactive-btn:focus {
        background: linear-gradient(90deg, #003366 60%, #005fa3 100%);
        color: #fff;
        transform: translateY(-2px) scale(1.04);
    }
    .dashboard-info-card {
        border-left: 6px solid #003366;
        background: linear-gradient(90deg, #f3f4f6 60%, #e0e7ef 100%);
    }
    @media (max-width: 700px) {
        .dashboard-action-card {
            min-height: 110px;
            padding: 1rem 0.5rem 0.7rem 0.5rem;
        }
        .dashboard-info-card {
            padding: 1.2rem 0.7rem;
        }
    }
</style>
@endpush

@push('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endpush
