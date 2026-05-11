@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create User</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.role-users.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
            <div class="card-body ">
                <form method="post" action="{{ route('admin.role-users.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Password</label>
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
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role')" />
                            </div>
                        </div>
                    </div>

                </form>

                <div class="card-footer text-end">
                    <button class="btn btn-primary mt-1" onclick="$('form').submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
