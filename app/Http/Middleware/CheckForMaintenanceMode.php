<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class CheckForMaintenanceMode
{
    public function handle(Request $request, Closure $next)
    {
        if ($this->app->isDownForMaintenance()) {
            throw new MaintenanceModeException(
                file_get_contents(base_path('storage/framework/down'))
            );
        }

        return $next($request);
    }
}
