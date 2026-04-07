<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    //
    function index() : View
    {
        return view('frontend.dashboard.main.index');
    }

    public function orders(): View
    {
        return view('frontend.dashboard.orders.index');
    }

    public function trackOrder(): View
    {
        return view('frontend.dashboard.track.index');
    }

    public function address(): View
    {
        return view('frontend.dashboard.address.index');
    }

    public function wishlist(): View
    {
        return view('frontend.dashboard.wishlist.index');
    }

    public function account(): View
    {
        return view('frontend.dashboard.account.index');
    }
}
