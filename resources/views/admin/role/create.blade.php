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
                <form method="post" action="{{ route('admin.role.store') }}" >
                    @csrf

                    <div class="row">
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label">Role Name</label>
                                <input type="text" class="form-control" name="role" value="">
                                <x-input-error :messages="$errors->get('role')" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        @foreach ($permissions as $groupName => $permission)
                            <div class="col md-4 mb-3">
                                <h3>{{ $groupName }}</h3>
                                @foreach ($permission as $item)
                                    <label for="" class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissions[]"
                                            value="{{ $item->name }}">

                                        <span class="form-check-label"></span>{{ $item->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                </form>

                <div class="card-footer text-end">
                    <button class="btn btn-primary mt-1" onclick="$('form').submit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
@endsection
