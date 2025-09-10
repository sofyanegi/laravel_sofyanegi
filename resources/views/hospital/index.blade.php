@extends('layouts.dashboard')
@section('title', 'Hospital')

@section('dashboard-content')
    <div class="container-fluid">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-2">
            <h1 class="h3 mb-0 fw-bold">Data Rumah Sakit</h1>
            <a href="{{ route('hospital.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Rumah Sakit
            </a>
        </div>

        <div id="alert-container"></div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th class="d-none d-sm-table-cell">Alamat</th>
                                <th>Email</th>
                                <th class="d-none d-md-table-cell">Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($hospitals as $hospital)
                                <tr id="row-{{ $hospital->id }}">
                                    <td>{{ $loop->iteration + $hospitals->firstItem() - 1 }}</td>
                                    <td>{{ $hospital->name }}</td>
                                    <td class="d-none d-sm-table-cell">{{ $hospital->address }}</td>
                                    <td>{{ $hospital->email }}</td>
                                    <td class="d-none d-md-table-cell">{{ $hospital->telephone }}</td>
                                    <td>
                                        <div class="btn-group d-flex d-md-inline-flex gap-1" role="group">
                                            <a href="{{ route('hospital.edit', $hospital) }}"
                                                class="btn btn-warning btn-sm flex-fill">
                                                <span class="d-none d-lg-inline">Edit</span>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm flex-fill btn-delete"
                                                data-id="{{ $hospital->id }}" data-name="{{ $hospital->name }}">
                                                <span class="d-none d-lg-inline">Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data rumah sakit</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if ($hospitals->hasPages())
                <div class="card-footer">
                    {{ $hospitals->links('pagination::bootstrap-5') }}
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
                    Apakah Anda yakin ingin menghapus <strong id="hospitalName"></strong>?
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
                $('#hospitalName').text(name);
                $('#deleteModal').modal('show');
            });

            $('#confirmDelete').on('click', function() {
                if (!deleteId) return;

                $.ajax({
                    url: '/hospital/' + deleteId,
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
        });
    </script>
@endpush
