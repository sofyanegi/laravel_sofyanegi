@extends('layouts.app')

@section('title', 'About Us')

@push('styles')
<style>
    .about-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 60px 0;
    }
</style>
@endpush

@section('content')
<div class="about-hero">
    <div class="container text-center">
        <h1>About Us</h1>
        <p class="lead">Discover our story and mission</p>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 mx-auto">
            <h2>Our Story</h2>
            <p>We are a passionate team dedicated to creating amazing web experiences...</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    console.log('About page loaded successfully!');
});
</script>
@endpush
