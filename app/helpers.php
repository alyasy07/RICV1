<?php

if (!function_exists('userRoute')) {
    /**
     * Generate route name based on user's role
     * Admin-only system - all routes use admin prefix
     *
     * @param string $routeName
     * @return string
     */
    function userRoute($routeName)
    {
        return 'admin.' . $routeName;
    }
}
