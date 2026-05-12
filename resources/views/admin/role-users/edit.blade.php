@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update User</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.role-users.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body ">
                <form method="post" action="{{ route('admin.role-users.update', $user->id) }}">
                    @csrf
                    @method('put')

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $user->name) }}">
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $user->email) }}">
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password <small class="text-muted">(Leave empty if not
                                        changing)</small></label>
                                <input type="password" class="form-control" name="password" value="">
                                <x-input-error :messages="$errors->get('password')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" value="">
                                <x-input-error :messages="$errors->get('password_confirmation')" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <select name="role" class="form-select">
                                    <option value="">Select Role</option>
                                    @foreach ($roles as $role)
                                        @if ($role->name !== 'Super Admin')
                                            <option value="{{ $role->name }}"
                                                {{ old('role', $user->roles->first()?->name) == $role->name ? 'selected' : '' }}>
                                                {{ $role->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role')" />
                            </div>
                        </div>
                    </div>

                </form>

                <div class="card-footer text-end">
                    <button class="btn btn-primary mt-1" onclick="$('form').submit()">Update</button>
                </div>
            </div>
        </div>
    </div>
@endsection
