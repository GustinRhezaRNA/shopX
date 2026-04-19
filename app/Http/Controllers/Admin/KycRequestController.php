<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kyc;
use App\Services\AlertService;
use App\Services\MailService;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class KycRequestController extends Controller
{
    //
    function index(): View
    {
        $kycRequests = Kyc::paginate(25);
        return view('admin.kyc.index', compact('kycRequests'));
    }

    function show(Kyc $kyc_request): View
    {
        return view('admin.kyc.show', compact('kyc_request'));
    }

    function download(Kyc $kyc_request): StreamedResponse
    {
        return Storage::disk('local')->download($kyc_request->document_scan_copy);
    }

    function update(Request $request, Kyc $kyc_request): RedirectResponse
    {
        $request->validate([
            'status' => ['required', 'in:approved,rejected,pending']
        ]);

        $kyc_request->update([
            'status' => $request->status
        ]);

        if ($kyc_request->status == 'rejected') {
            MailService::send(
                to: $kyc_request->user->email,
                subject: 'our KYC Application Has Been Rejected',
                body: 'Sorry!, your KYC Application has been rejected.'
            );
        } elseif ($kyc_request->status == 'approved') {
            MailService::send(
                to: $kyc_request->user->email,
                subject: 'Your KYC Application Has Been Approved',
                body: 'Congratulations!, your KYC Application has been approved.'
            );
        }

        AlertService::updated('Kyc Status Updated Successfully.');
        return redirect()->route('admin.kyc.index');
    }

}
