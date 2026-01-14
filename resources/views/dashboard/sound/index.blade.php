@extends('layouts.dashboard.app')
@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>{{ ucwords($title) }}</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.html">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                {{ ucwords($title) }}
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title">Data {{ ucwords($title) }}</h5>
                        <a href="{{ route('sound.create') }}" class="btn btn-primary addRole ms-auto">Tambah
                            {{ ucwords($title) }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-custom">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Path File</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ ucwords($item->name) }}</td>
                                    <td>{{ $item->path_file }}</td>
                                    <td>
                                        <button class="btn btn-success btn-sm playSound"
                                            data-src="{{ asset($item->path_file) }}">
                                            ▶ Play
                                        </button>
                                        <a href="{{ route('sound.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm editRole">
                                            Edit
                                        </a>

                                        <button class="btn btn-danger btn-sm deleteRole" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
    {{-- delete --}}
    <div class="modal fade" id="deleteRoleModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <form id="deleteRoleForm">
                @csrf
                @method('DELETE')

                <input type="hidden" name="id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger">Hapus Role</h5>
                    </div>

                    <div class="modal-body">
                        <p>Yakin ingin menghapus role
                            <strong id="deleteRoleName"></strong>?
                        </p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">
                            Hapus
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script')
    <script>
        let audio = new Audio();

        $(document).on('click', '.playSound', function() {
            let src = $(this).data('src');

            // stop audio sebelumnya
            audio.pause();
            audio.currentTime = 0;

            audio.src = src;
            audio.play();
        });

        $(document).ready(function() {
            // ===== DELETE =====
            $(document).on('click', '.deleteRole', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');

                $('#deleteRoleForm input[name=id]').val(id);
                $('#deleteRoleName').text(name);

                $('#deleteRoleModal').modal('show');
            });

            $('#deleteRoleForm').submit(function(e) {
                e.preventDefault();

                let id = $(this).find('input[name=id]').val();

                $.ajax({
                    url: `/dashboard/sound/${id}`,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function() {
                        $('#deleteRoleModal').modal('hide');
                        location.reload();
                    }
                });
            });
        });
    </script>
@endpush
