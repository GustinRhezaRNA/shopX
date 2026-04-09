<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AlertService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;



class ProfileController extends Controller
{
    function index(): View
    {
        return view('frontend.dashboard.account.index');
    }

    function profileUpdate(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => ['required','string','max:50'],
            'email' => ['required','email','unique:users,email,'.auth('web')->user()->id],
        ]);

        $user = auth('web')->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        AlertService::updated('Profile Updated Successfully.');
        

        return redirect()->back();
        
    }
}
