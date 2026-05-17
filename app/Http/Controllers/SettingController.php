<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Services\AlertService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingController extends Controller
{
    //
    function index() : View
    {
        return view('admin.settings.sections.general-settings');
    }

    function generalSettings() : RedirectResponse
    {

        // Validate the request data
        $validatedData = request()->validate([
            'site_name' => 'required|string|max:255',
            'site_contact' => 'nullable|email|max:255',
            'site_phone' => 'nullable|string|max:20',
        ]);


        // Redirect back with a success message
        foreach ($validatedData as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        AlertService::updated('Settings updated successfully.');
        return Redirect::back();
    }

}
