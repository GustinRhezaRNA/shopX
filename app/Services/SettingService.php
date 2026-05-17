<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

class SettingService {

    function getSettings() {
        return Cache::rememberForever('settings', function () {
            return Setting::all()->pluck('value', 'key')->toArray();
        });
    }

    function setSettings(){
        $settings = $this->getSettings();
        config(['settings' => $settings]);
    }

    function clearCachedSettings(){
        Cache::forget('settings');
    }
}
