<?php
// Check if user has permission
if (!function_exists('hasPermission')) {
    function hasPermission(array $permissions): bool
    {
        $user = auth('admin')->user();

        if (!$user) {
            return false;
        }

        return $user->hasAnyPermission($permissions);
    }
}
