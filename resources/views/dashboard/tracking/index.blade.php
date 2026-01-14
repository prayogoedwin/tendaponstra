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
                                <th>Nama Device</th>
                                <th>Lat</th>
                                <th>Lng</th>
                                <th>Batt</th>
                                <th>Obj Dist</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ ucwords($item->device->device_name) }}</td>
                                    <td>{{ $item->lat }}</td>
                                    <td>{{ $item->lng }}</td>
                                    <td>{{ $item->batt }}</td>
                                    <td>{{ $item->obj_dist }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm editRole" data-id="{{ $item->id }}"
                                            data-name="{{ $item->device_id }}" data-lat="{{ $item->lat }}"
                                            data-lng="{{ $item->lng }}" data-batt="{{ $item->batt }}"
                                            data-obj-dist="{{ $item->obj_dist }}">
                                            Edit
                                        </button>

                                        <button class="btn btn-danger btn-sm deleteRole" data-id="{{ $item->id }}"
                                            data-name="{{ $item->device_id }}" data-lat="{{ $item->lat }}"
                                            data-lng="{{ $item->lng }}" data-batt="{{ $item->batt }}"
                                            data-obj-dist="{{ $item->obj_dist }}">
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
                            <label>Device</label>
                            <select name="device_id" class="form-select" id="">
                                <option value="" disabled selected>-- Select Device --</option>
                                @foreach ($devices as $item)
                                    <option value="{{ $item->id }}">{{ $item->device_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Latitude</label>
                            <input type="text" name="lat" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Longitude</label>
                            <input type="text" name="lng" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Batt</label>
                            <input type="text" name="batt" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Obj Dist</label>
                            <input type="text" name="obj_dist" class="form-control">
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
                            <label>Device</label>
                            <select name="device_id" class="form-select" id="">
                                <option value="" disabled selected>-- Select Device --</option>
                                @foreach ($devices as $item)
                                    <option value="{{ $item->id }}">{{ $item->device_name }}</option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Latitude</label>
                            <input type="text" name="lat" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Longitude</label>
                            <input type="text" name="lng" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Batt</label>
                            <input type="text" name="batt" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Obj Dist</label>
                            <input type="text" name="obj_dist" class="form-control">
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
                        <h5 class="modal-title text-danger">Hapus {{ ucwords($title) }}</h5>
                    </div>

                    <div class="modal-body">
                        <p>Yakin ingin menghapus?
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
                    url: "{{ route('tracking.store') }}",
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
                let lat = $(this).data('lat');
                let lng = $(this).data('lng');
                let batt = $(this).data('batt');
                let obj_dist = $(this).data('objDist');

                $('#editRoleForm')[0].reset();
                $('#editRoleForm input[name=id]').val(id);
                $('select[name=device_id]').val($(this).data('name'));
                $('#editRoleForm input[name=lat]').val(lat);
                $('#editRoleForm input[name=lng]').val(lng);
                $('#editRoleForm input[name=batt]').val(batt);
                $('#editRoleForm input[name=obj_dist]').val(obj_dist);
                $('.form-control').removeClass('is-invalid');

                $('#editRoleModal').modal('show');
            });

            $('#editRoleForm').submit(function(e) {
                e.preventDefault();

                let id = $(this).find('input[name=id]').val();

                $.ajax({
                    url: `/dashboard/tracking/${id}`,
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
                    url: `/dashboard/tracking/${id}`,
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
