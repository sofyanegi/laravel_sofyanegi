@extends('layouts.app')

@section('content')
    <x-navbar />
    <div class="container mt-4">
        @yield('dashboard-content')
    </div>
@endsection
