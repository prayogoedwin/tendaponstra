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
                                <th>Device ID</th>
                                <th>Device Name</th>
                                <th>Device Password</th>
                                <th>URL Stream</th>
                                <th>Port</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $item->device_id }}</td>
                                    <td>{{ $item->device_name }}</td>
                                    <td>{{ $item->device_password }}</td>
                                    <td>{{ $item->url_stream }}</td>
                                    <td>{{ $item->port }}</td>
                                    <td>
                                        <button class="btn btn-primary btn-sm editRole" data-id="{{ $item->id }}"
                                            data-device-name="{{ $item->device_name }}"
                                            data-device-id="{{ $item->device_id }}"
                                            data-device-password="{{ $item->device_password }}"
                                            data-url-stream="{{ $item->url_stream }}" data-port="{{ $item->port }}"
                                            data-websocket-port="{{ $item->websocket_port }}"
                                            data-tlsmqtt-url="{{ $item->tls_mqtt_url }}"
                                            data-tlswebsocket-url="{{ $item->tls_websocket_url }}"
                                            data-username="{{ $item->username }}" data-password="{{ $item->password }}"
                                            data-urlmqtt="{{ $item->url_mqtt }}" data-prefix="{{ $item->prefix_topic }}"
                                            data-client-id="{{ $item->client_id }}">
                                            Edit
                                        </button>
                                        <button class="btn btn-danger btn-sm deleteRole" data-id="{{ $item->id }}"
                                            data-device-name="{{ $item->device_name }}"
                                            data-device-id="{{ $item->device_id }}"
                                            data-device-password="{{ $item->device_password }}"
                                            data-url-stream="{{ $item->url_stream }}">
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
                            <label>Nama Device</label>
                            <input type="text" name="device_name" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Device ID</label>
                            <input type="text" name="device_id" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Device Password</label>
                            <input type="text" name="device_password" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>URL Stream</label>
                            <input type="text" name="url_stream" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Prefix Topic</label>
                            <input type="text" name="prefix_topic" placeholder="/tongkat1" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Client ID</label>
                            <input type="text" name="client_id"
                                placeholder="Masukkan sesuai dengan yang diberikan device" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>PORT</label>
                            <input type="text" name="port" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Websocket PORT</label>
                            <input type="text" name="websocket_port" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>TLS MQTT URL</label>
                            <input type="text" name="tls_mqtt_url" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>TLS Websocket URL</label>
                            <input type="text" name="tls_websocket_url" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>URL</label>
                            <input type="text" name="url_mqtt" class="form-control">
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
                            <label>Nama Device</label>
                            <input type="text" name="device_name" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Device ID</label>
                            <input type="text" name="device_id" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Device Password</label>
                            <input type="text" name="device_password" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>URL Stream</label>
                            <input type="text" name="url_stream" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Prefix Topic</label>
                            <input type="text" name="prefix_topic" placeholder="/tongkat1" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Client ID</label>
                            <input type="text" name="client_id"
                                placeholder="Masukkan sesuai dengan yang diberikan device" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Username</label>
                            <input type="text" name="username" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="text" name="password" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>PORT</label>
                            <input type="text" name="port" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>Websocket PORT</label>
                            <input type="text" name="websocket_port" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>TLS MQTT URL</label>
                            <input type="text" name="tls_mqtt_url" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>TLS Websocket URL</label>
                            <input type="text" name="tls_websocket_url" class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label>URL</label>
                            <input type="text" name="url_mqtt" class="form-control">
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
                        <p>Yakin ingin menghapus device
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
                    url: "{{ route('device.store') }}",
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
                let deviceName = $(this).data('deviceName');
                let deviceId = $(this).data('deviceId');
                let devicePassword = $(this).data('devicePassword');
                let urlStream = $(this).data('urlStream');
                let port = $(this).data('port');
                let websocketPort = $(this).data('websocketPort');
                let tlsmqttUrl = $(this).data('tlsmqttUrl');
                let tlswebsocketUrl = $(this).data('tlswebsocketUrl');
                let username = $(this).data('username');
                let password = $(this).data('password');
                let urlMqtt = $(this).data('urlmqtt');
                let clientId = $(this).data('clientId');
                let prefix = $(this).data('prefix');

                $('#editRoleForm')[0].reset();
                $('#editRoleForm input[name=id]').val(id);
                $('#editRoleForm input[name=device_name]').val(deviceName);
                $('#editRoleForm input[name=device_id]').val(deviceId);
                $('#editRoleForm input[name=device_password]').val(devicePassword);
                $('#editRoleForm input[name=url_stream]').val(urlStream);
                $('#editRoleForm input[name=port]').val(port);
                $('#editRoleForm input[name=websocket_port]').val(websocketPort);
                $('#editRoleForm input[name=tls_mqtt_url]').val(tlsmqttUrl);
                $('#editRoleForm input[name=tls_websocket_url]').val(tlswebsocketUrl);
                $('#editRoleForm input[name=username]').val(username);
                $('#editRoleForm input[name=password]').val(password);
                $('#editRoleForm input[name=url_mqtt]').val(urlMqtt);
                $('#editRoleForm input[name=client_id]').val(clientId);
                $('#editRoleForm input[name=prefix_topic]').val(prefix);

                $('.form-control').removeClass('is-invalid');
                $('#editRoleModal').modal('show');
            });

            $('#editRoleForm').submit(function(e) {
                e.preventDefault();

                let id = $(this).find('input[name=id]').val();

                $.ajax({
                    url: `/dashboard/device/${id}`,
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
                let deviceName = $(this).data('deviceName');

                $('#deleteRoleForm input[name=id]').val(id);
                $('#deleteRoleName').text(deviceName);

                $('#deleteRoleModal').modal('show');
            });

            $('#deleteRoleForm').submit(function(e) {
                e.preventDefault();

                let id = $(this).find('input[name=id]').val();

                $.ajax({
                    url: `/dashboard/device/${id}`,
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
