@extends('layouts.dashboard')
@section('title', 'Dashboard')

@section('dashboard-content')
    <h1 class="mb-4">Dashboard</h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Rumah Sakit</h5>
                    <p class="card-text fs-3">{{ $hospitalCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Pasien</h5>
                    <p class="card-text fs-3">{{ $patientCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">User Login</h5>
                    <p class="card-text fs-3">{{ auth()->user()->username ?? 'Guest' }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
