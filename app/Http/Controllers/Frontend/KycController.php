<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KycController extends Controller
{
    use FileUploadTrait;

    function index(): View
    {
        return view('frontend.pages.kyc');
    }

    function store(Request $request): RedirectResponse
    {
        $request->validate([
            'full_name' => ['required', 'string', 'max:100'],
            'date_of_birth' => ['required', 'date'],
            'gender' => ['required', 'in:male,female'],
            'full_address' => ['required', 'string'],
            'document_type' => ['required', 'in:passport,id_card,driving_license'],
            'document_scan_copy' => [
                'required',
                'file',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:2048'
            ]
        ]);

        $kyc = new Kyc();


        $kyc->full_name = $request->full_name;
        $kyc->user_id = auth('web')->user()->id;
        $kyc->date_of_birth = $request->date_of_birth;
        $kyc->gender = $request->gender;
        $kyc->full_address = $request->full_address;
        $kyc->document_type = $request->document_type;
        $filePath = $this->uploadPrivateFile($request->file('document_scan_copy'));
        $kyc->document_scan_copy = $filePath;
        $kyc->save();


        AlertService::updated('Your KYC has been submitted successfully! Please wait for admin approval ');
        return redirect()->route('kyc.index');

    }
}
