@extends('backend.master')

@section('title', 'Backend - Roles')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Roles Management</h4>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Bootstrap Table with Header - Light -->
        <div class="card">
            <h5 class="card-header">
                Roles List
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                        data-bs-target="#createRoleModal">
                    <i class="bx bx-plus"></i> Add Role
                </button>
            </h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Guard Name</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @forelse($roles as $role)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><strong>{{ $role->name }}</strong></td>
                            <td>{{ $role->guard_name }}</td>
                            <td>{{ $role->created_at->format('Y-m-d') }}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"
                                           data-bs-toggle="modal"
                                           data-bs-target="#showRoleModal{{ $role->id }}">
                                            <i class="bx bx-show me-1"></i> Show
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0);"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editRoleModal{{ $role->id }}">
                                            <i class="bx bx-edit-alt me-1"></i> Edit
                                        </a>
                                        <form action="{{ route('backend.roles.destroy', $role) }}" method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this role?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item">
                                                <i class="bx bx-trash me-1"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Show Modal -->
                        <div class="modal fade" id="showRoleModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Role Details: {{ $role->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="edit_name{{ $role->id }}" class="form-label">Name</label>
                                            <p class="form-control">{{ $role->name }}</p>
                                        </div>
                                        <div class="form-group mb-3 col-12 mt-2">
                                            <label class="form-label"><strong>Permissions:</strong></label>
                                            <div class="row">
                                                @if($permissions->count() > 0)
                                                    @foreach($permissions as $permission)
                                                        <div class="col-md-6">
                                                            <div class="form-check form-check-primary mt-1">
                                                                <input class="form-check-input" type="checkbox"
                                                                       id="show_permission_{{ $role->id }}_{{ $permission->id }}"
                                                                       disabled
                                                                        @checked($role->hasPermissionTo($permission->name))>
                                                                <label class="form-check-label"
                                                                       for="show_permission_{{ $role->id }}_{{ $permission->id }}">
                                                                    {{ $permission->name }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary"
                                                data-bs-dismiss="modal">Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Edit Modal -->
                        <div class="modal fade" id="editRoleModal{{ $role->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <form action="{{ route('backend.roles.update', $role) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Role</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="edit_name{{ $role->id }}" class="form-label">Name</label>
                                                <input type="text"
                                                       class="form-control @error('name') is-invalid @enderror"
                                                       id="edit_name{{ $role->id }}" name="name"
                                                       value="{{ old('name', $role->name) }}" required>
                                                @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3 col-12 mt-2">
                                                <label class="form-label"><strong>Permissions:</strong></label>
                                                <div class="row">
                                                    @if(count($permissions) > 0)
                                                        @foreach($permissions as $permission)
                                                            <div class="col-md-6">
                                                                <div class="form-check form-check-primary mt-1">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           id="edit_permission_{{ $role->id }}_{{ $permission->id }}"
                                                                           name="permissions[{{ $permission->name }}]"
                                                                            {{ $role->hasPermissionTo($permission->name) ? 'checked' : '' }}>
                                                                    <label class="form-check-label"
                                                                           for="edit_permission_{{ $role->id }}_{{ $permission->id }}">
                                                                        {{ $permission->name }}
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">Cancel
                                            </button>
                                            <button type="submit" class="btn btn-primary">Update Role</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No roles found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Bootstrap Table with Header - Light -->
    </div>
    <!-- / Content -->

    <!-- Create Modal -->
    <div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('backend.roles.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Create New Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3 col-12 mt-2">
                            <div class="row">
                                @if(count($permissions) > 0)
                                    @foreach($permissions as $permission)
                                        <div class="col-md-6">
                                            <div class="form-check form-check-primary mt-1">
                                                <input class="form-check-input" type="checkbox"
                                                       id="permission_{{ $permission->id }}"
                                                       name="permissions[{{ $permission->name }}]">
                                                <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                    {{ $permission->name }}
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">Create Role</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection