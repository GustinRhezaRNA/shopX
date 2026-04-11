<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class KycController extends Controller
{
    //
    function index(): View
    {
        return view('frontend.pages.kyc');
    }

    function test(Request $request)
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


        
    }
}
