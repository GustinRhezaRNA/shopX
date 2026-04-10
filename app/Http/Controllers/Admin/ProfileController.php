<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AlertService;
use App\Traits\FileUploadTrait;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends Controller
{

    use FileUploadTrait;

    function index(): View
    {
        return view('admin.profile.index');
    }

    function profileUpdate(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'email', 'unique:users,email,' . auth('admin')->user()->id],
            'avatar' => ['nullable', 'image', 'max:2048']
        ]);

        /** @var \App\Models\User $user */
        $user = auth('admin')->user();


        $filepath = $this->uploadFile($request->file('avatar'), $user->avatar);
        $filepath ? $user->avatar = $filepath : null;

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        AlertService::updated('Profile Updated Successfully.');

        return redirect()->back();
    }

    function passwordUpdate(Request $request): RedirectResponse
    {

        $request->validate([
            'current_password' => ['required', 'string', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        /** @var \App\Models\User $user */
        $user = auth('admin')->user();
        $user->password = bcrypt($request->password);
        $user->save();
        AlertService::updated('Password Updated Successfully.');

        return redirect()->back();
    }



}
