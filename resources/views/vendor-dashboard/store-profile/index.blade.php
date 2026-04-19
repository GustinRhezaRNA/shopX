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
                                <x-input-image id="image-preview" name="avatar" image="" />
                            </div>
                        </div>

                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ auth('admin')->user()->name }}">
                                <x-input-error :messages="$errors->get('name')" />
                            </div>

                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Update Account
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