@extends('layouts.dashboard')
@section('title', 'Patient')

@section('dashboard-content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <h1 class="h3 mb-0 fw-bold">Data Pasien</h1>
            <a href="{{ route('patient.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Pasien
            </a>
        </div>

        <div id="alert-container"></div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="mb-3 card card-body">
            <label for="hospitalFilter" class="form-label fw-semibold">Filter Rumah Sakit</label>
            <select id="hospitalFilter" class="form-select w-auto">
                <option value="all">Semua Rumah Sakit</option>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th class="d-none d-sm-table-cell">Alamat</th>
                                <th class="d-none d-md-table-cell">Telepon</th>
                                <th>Rumah Sakit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="patientTable">
                            @forelse ($patients as $patient)
                                <tr id="row-{{ $patient->id }}">
                                    <td>{{ $loop->iteration + $patients->firstItem() - 1 }}</td>
                                    <td>{{ $patient->name }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $patient->address }}</td>
                                    <td class="d-none d-md-table-cell">{{ $patient->telephone_number }}</td>
                                    <td>{{ $patient->hospital->name ?? '-' }}</td>
                                    <td>
                                        <div class="btn-group d-flex d-md-inline-flex gap-1" role="group">
                                            <a href="{{ route('patient.edit', $patient) }}"
                                                class="btn btn-warning btn-sm flex-fill">
                                                <span class="d-none d-lg-inline">Edit</span>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm flex-fill btn-delete"
                                                data-id="{{ $patient->id }}" data-name="{{ $patient->name }}">
                                                <span class="d-none d-lg-inline">Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data pasien</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($patients->hasPages())
                <div class="card-footer" id="paginationWrapper">
                    {{ $patients->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel"><i class="bi bi-exclamation-triangle me-2"></i> Konfirmasi
                        Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus <strong id="patientName"></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Ya, Hapus</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(function() {
            let deleteId = null;

            function showAlert(type, message) {
                let alertHtml = `
                    <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                        ${message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>`;
                $('#alert-container').html(alertHtml);
            }

            $(document).on('click', '.btn-delete', function() {
                deleteId = $(this).data('id');
                let name = $(this).data('name');
                $('#patientName').text(name);
                $('#deleteModal').modal('show');
            });

            $('#confirmDelete').on('click', function() {
                if (!deleteId) return;

                $.ajax({
                    url: '/patient/' + deleteId,
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#row-' + deleteId).fadeOut(500, function() {
                            $(this).remove();
                        });
                        $('#deleteModal').modal('hide');
                        showAlert('success', response.message);
                    },
                    error: function(xhr) {
                        $('#deleteModal').modal('hide');
                        showAlert('danger', "Terjadi kesalahan: " + (xhr.responseJSON
                            ?.message ?? 'Gagal hapus data'));
                    }
                });
            });

            $('#hospitalFilter').change(function() {
                let hospitalId = $(this).val();
                $.ajax({
                    url: '/patient/filter/' + hospitalId,
                    type: 'GET',
                    success: function(data) {
                        let rows = "";
                        if (data.length > 0) {
                            $.each(data, function(index, patient) {
                                rows += `
                                    <tr id="row-${patient.id}">
                                        <td>${index+1}</td>
                                        <td>${patient.name}</td>
                                        <td class="d-none d-sm-table-cell">${patient.address}</td>
                                        <td class="d-none d-md-table-cell">${patient.telephone_number}</td>
                                        <td>${patient.hospital ? patient.hospital.name : '-'}</td>
                                        <td>
                                            <div class="btn-group d-flex d-md-inline-flex gap-1" role="group">
                                                <a href="/patient/${patient.id}/edit" class="btn btn-warning btn-sm flex-fill">
                                                    <span class="d-none d-lg-inline">Edit</span>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm flex-fill btn-delete"
                                                    data-id="${patient.id}" data-name="${patient.name}">
                                                    <span class="d-none d-lg-inline">Hapus</span>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                `;
                            });
                        } else {
                            rows =
                                `<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>`;
                        }

                        $('#patientTable').html(rows);

                        if (hospitalId !== 'all') {
                            $('#paginationWrapper').hide();
                        } else {
                            $('#paginationWrapper').show();
                        }
                    },
                    error: function() {
                        showAlert('danger', 'Gagal memuat data pasien');
                    }
                });
            });
        });
    </script>
@endpush
