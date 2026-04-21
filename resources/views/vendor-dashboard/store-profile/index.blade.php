@extends('vendor-dashboard.layouts.app')

@section('contents')
    <div class="container-xl">

        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Update Profile</h3>
            </div>

            <div class="card-body">
                <form method="post" action="{{ route('vendor.store-profile.update', 1) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label ">Logo</label>
                                <x-input-image imageUploadId="image-upload" imagePreviewId="image-preview" imageLabelId="image-label" name="logo" image="{{ $store?->logo ?? '/defaults/vendor-logo.webp' }}" />
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="" class="form-label ">Banner</label>
                                <x-input-image imageUploadId="image-upload-two" imagePreviewId="image-preview-two" imageLabelId="image-label-two" name="banner" image="{{ $store?->banner ?? '/defaults/banner.webp' }}" />
                                <x-input-error :messages="$errors->get('banner')" class="mt-2" />
                            </div>  
                        </div>

                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $store->name ?? auth('web')->user()->name) }}">
                                <x-input-error :messages="$errors->get('name')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Email</label>
                                <input type="email" class="form-control" name="email" value="{{ old('email', $store->email ?? auth('web')->user()->email) }}" required>
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label required">Phone</label>
                                <input type="tel" class="form-control" name="phone" value="{{ old('phone', $store->phone ?? '') }}" required>
                                <x-input-error :messages="$errors->get('phone')" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Address</label>
                                <input type="text" class="form-control" name="address" value="{{ old('address', $store->address ?? '') }}" required>
                                <x-input-error :messages="$errors->get('address')" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Short Description</label>
                                <textarea class="form-control" name="short_description" required>{{ old('short_description', $store->short_description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('short_description')" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label class="form-label required">Long Description</label>
                                <textarea id="editor" class="form-control" name="long_description">{{ old('long_description', $store->long_description ?? '') }}</textarea>
                                <x-input-error :messages="$errors->get('long_description')" />
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
            $.uploadPreview({
                input_field: "#image-upload-two", // Default: .image-upload
                preview_box: "#image-preview-two", // Default: .image-preview
                label_field: "#image-label-two", // Default: .image-label
                label_default: "Choose File", // Default: Choose File
                label_selected: "Change File", // Default: Change File
                no_label: false // Default: false
            });
        });
    </script>
@endpush