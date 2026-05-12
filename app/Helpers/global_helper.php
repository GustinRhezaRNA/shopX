<?php
// Check if user has permission
if (!function_exists('hasPermission')) {
    function hasPermission(array $permissions): bool
    {
        $user = auth('admin')->user();

        if (!$user) {
            return false;
        }

        if ($user->hasRole('Super Admin')) {
            return true;
        }

        return $user->hasAnyPermission($permissions);
    }
}
