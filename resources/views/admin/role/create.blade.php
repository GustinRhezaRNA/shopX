@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Create Roles</h3>
                <div class="card-actions">
                    <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Create Role</a>
                </div>
            </div>
            <div class="card-body ">
                <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="role" value="">
                                <x-input-error :messages="$errors->get('role')" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Account
                    </button>
                </form>

                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
