@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">All Roles Users</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.role-users.create') }}" class="btn btn-primary">Create User</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>No. </th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach ($user->roles as $role)
                                                <span class="badge bg-primary-lt">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-secondary">
                                            @if (!$user->hasRole('Super Admin'))
                                                <a href="{{ route('admin.role-users.edit', $user->id) }}">Edit</a>
                                                <a class="text-danger delete-item"
                                                    href="{{ route('admin.role-users.destroy', $user->id) }}">Delete</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No users found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
