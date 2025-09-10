@extends('layouts.dashboard')

@section('title', 'Tambah Pasien')

@section('dashboard-content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <h1 class="h3 mb-0 fw-bold">
                <i class="bi bi-hospital me-2"></i> Tambah Pasien
            </h1>
        </div>

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-x-octagon-fill me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('patient.store') }}" method="POST" novalidate>
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama</label>
                        <input id="name" type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required
                            placeholder="Masukkan nama pasien">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label fw-semibold">Alamat</label>
                        <textarea id="address" name="address" rows="3" class="form-control @error('address') is-invalid @enderror"
                            required placeholder="Masukkan alamat pasien">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="telephone_number" class="form-label fw-semibold">Telepon</label>
                        <input id="telephone_number" type="text" name="telephone_number"
                            class="form-control @error('telephone_number') is-invalid @enderror"
                            value="{{ old('telephone_number') }}" required placeholder="08xxxx">
                        @error('telephone_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="id_hospital" class="form-label fw-semibold">Rumah Sakit</label>
                        <select name="id_hospital" class="form-select" required>
                            <option value="">-- Pilih Rumah Sakit --</option>
                            @foreach ($hospitals as $hospital)
                                <option value="{{ $hospital->id }}"
                                    {{ old('id_hospital') == $hospital->id ? 'selected' : '' }}>
                                    {{ $hospital->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2 mt-4">
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                        <a href="{{ route('hospital.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-1"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
