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
                        <a href="#" class="btn btn-primary addRole ms-auto" data-bs-toggle="modal"
                            data-bs-target="#roleModal">Tambah {{ ucwords($title) }}</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-custom">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ ucwords($item->name) }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @foreach ($item->getRoleNames() as $list)
                                            {{ $list }}
                                        @endforeach
                                    </td>
                                    <td>
                                        <button class="btn btn-primary btn-sm editRole" data-id="{{ $item->id }}"
                                            data-name="{{ $item->name }}" data-email="{{ $item->email }}"
                                            data-role="{{ $item->getRoleNames()->first() }}">
                                            Edit
                                        </button>

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
    <div class="modal fade text-left" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel4"
        data-bs-backdrop="false" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="roleForm">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="myModalLabel4">Tambah {{ ucwords($title) }}</h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama</label>
                            <input type="text" name="name" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-select" id="">
                                <option value="" disabled selected>-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Accept</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- edit --}}
    <div class="modal fade" id="editRoleModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <form id="editRoleForm">
                @csrf
                @method('PUT')

                <input type="hidden" name="id">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit {{ ucwords($title) }}</h5>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Nama Role</label>
                            <input type="text" name="name" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Role</label>
                            <select name="role" class="form-select" id="">
                                <option value="" disabled selected>-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
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
                        <p>Yakin ingin menghapus user
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
        $(document).ready(function() {
            $('#roleForm').on('submit', function(e) {
                e.preventDefault();

                let form = $(this);

                $.ajax({
                    url: "{{ route('user.store') }}",
                    type: "POST",
                    data: form.serialize(),
                    success: function(res) {
                        if (res.status) {
                            $('#roleModal').modal('hide');
                            location.reload(); // atau append row ke table
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;

                        $('.form-control').removeClass('is-invalid');

                        $.each(errors, function(key, value) {
                            let input = $('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').text(value[0]);
                        });
                    }
                });
            });

            // ===== EDIT =====
            $('.editRole').on('click', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                let email = $(this).data('email');
                let role = $(this).data('role');

                $('#editRoleForm')[0].reset();
                $('#editRoleForm input[name=id]').val(id);
                $('#editRoleForm input[name=name]').val(name);
                $('#editRoleForm input[name=email]').val(email);
                $('select[name=role]').val($(this).data('role'));
                $('.form-control').removeClass('is-invalid');

                $('#editRoleModal').modal('show');
            });

            $('#editRoleForm').submit(function(e) {
                e.preventDefault();

                let id = $(this).find('input[name=id]').val();

                $.ajax({
                    url: `/dashboard/user/${id}`,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(res) {
                        if (res.status) {
                            $('#editRoleModal').modal('hide');
                            location.reload();
                        } else {
                            alert(res.message);
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;

                        $('.form-control').removeClass('is-invalid');
                        $.each(errors, function(key, value) {
                            let input = $('[name="' + key + '"]');
                            input.addClass('is-invalid');
                            input.next('.invalid-feedback').text(value[0]);
                        });
                    }
                });
            });

            // ===== DELETE =====
            $('.deleteRole').on('click', function() {
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
                    url: `/dashboard/user/${id}`,
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
