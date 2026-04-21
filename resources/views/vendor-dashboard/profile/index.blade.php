@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="" class="form-label ">Avatar</label>
                                <x-input-image name="avatar" :image="auth('admin')->user()->avatar" imageUploadId="image-upload" imagePreviewId="image-preview" imageLabelId="image-label" />
                                <x-input-error :messages="$errors->get('avatar')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ auth('admin')->user()->name }}">
                                <x-input-error :messages="$errors->get('name')" />
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ auth('admin')->user()->email }}">
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Account
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Update Password</h3>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('admin.profile.password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">
                            Current Password <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" name="current_password" type="password" required>
                        <x-input-error :messages="$errors->get('current_password')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            New Password <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" name="password" type="password" required>
                        <x-input-error :messages="$errors->get('password')" />
                    </div>

                    <div class="mb-3">
                        <label class="form-label">
                            Confirm Password <span class="text-danger">*</span>
                        </label>
                        <input class="form-control" name="password_confirmation" type="password" required>
                        <x-input-error :messages="$errors->get('password_confirmation')" />
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Save Changes
                    </button>
                </form>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "Choose File", // Default: Choose File
                label_selected: "Change File", // Default: Change File
                no_label: false // Default: false
            });
        });
    </script>
@endpush