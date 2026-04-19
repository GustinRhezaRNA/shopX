@extends('frontend.layouts.app')

@section('contents')
    <x-frontend.breadcrumb :items="[
            ['url' => '/', 'label' => 'Home', 'icon' => 'fa-solid fa-house'],
            ['label' => 'Verification', 'icon' => 'fa-solid fa-right-to-bracket'],
        ]" />
    <div class="page-content pt-150 pb-135">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row ">
                        <div class="col-lg-6 col-md-8 offset-md-3">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1 mb-4">
                                        <h1 class="mb-5">Kyc Verification</h1>
                                    </div>
                                    <form method="post"  action="{{ route('kyc.store') }}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label class="mb-2 font-weight-bold">Full Name <span class="text-danger">*</span></label>
                                            <input type="text" required="" name="full_name" placeholder="Enter your full name"
                                                value="{{ old('full_name') }}" />
                                            <x-input-error :messages="$errors->get('full_name')" class="mt-2" />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="mb-2 font-weight-bold">Date of Birth <span class="text-danger">*</span></label>
                                            <input type="text" class="datepicker form-control" required="" name="date_of_birth" placeholder="Select your date of birth"
                                                value="{{ old('date_of_birth') }}" style="color: #6c757d;" />
                                            <x-input-error :messages="$errors->get('date_of_birth')" class="mt-2" />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="mb-2 font-weight-bold">Gender <span class="text-danger">*</span></label>
                                            <select required="" name="gender" class="form-select" style="width: 100%; height: 64px; border: 1px solid #ececec; border-radius: 10px; padding-left: 20px; color: #6c757d;">
                                                <option value="">Select Gender</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="mb-2 font-weight-bold">Full Address <span class="text-danger">*</span></label>
                                            <input type="text" required="" name="full_address" placeholder="Enter your full address"
                                                value="{{ old('full_address') }}" />
                                            <x-input-error :messages="$errors->get('full_address')" class="mt-2" />
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="mb-2 font-weight-bold">Document Type <span class="text-danger">*</span></label>
                                            <select required="" name="document_type" class="form-select" style="width: 100%; height: 64px; border: 1px solid #ececec; border-radius: 10px; padding-left: 20px; color: #6c757d;">
                                                <option value="">Select Document Type</option>
                                                <option value="passport" {{ old('document_type') == 'passport' ? 'selected' : '' }}>Passport</option>
                                                <option value="id_card" {{ old('document_type') == 'id_card' ? 'selected' : '' }}>ID Card</option>
                                                <option value="driving_license" {{ old('document_type') == 'driving_license' ? 'selected' : '' }}>Driving License</option>
                                            </select>
                                            <x-input-error :messages="$errors->get('document_type')" class="mt-2" />
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="mb-2 font-weight-bold">Document Scan Copy <span class="text-danger">*</span></label>
                                            <input type="file" required="" name="document_scan_copy" class="form-control" style="padding-top: 15px; height: 64px; border: 1px solid #ececec; border-radius: 10px; padding-left: 20px;" />
                                            <x-input-error :messages="$errors->get('document_scan_copy')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up"
                                                name="">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection