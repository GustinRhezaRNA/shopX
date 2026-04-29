<?php

namespace App\Services;
use Flasher\Notyf\Prime\NotyfInterface;

class AlertService
{
    public static function updated($message = null)

    {
        $notyf = app(NotyfInterface::class);
        $notyf->success($message ? $message : 'Updated Successfully');
    }
    public static function created($message = null)

    {
        $notyf = app(NotyfInterface::class);
        $notyf->success($message ? $message : 'Created Successfully');
    }
    public static function deleted($message = null)

    {
        $notyf = app(NotyfInterface::class);
        $notyf->success($message ? $message : 'Deleted Successfully');
    }
}
