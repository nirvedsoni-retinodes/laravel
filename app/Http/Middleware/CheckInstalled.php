<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CheckInstalled
{
    public function handle(Request $request, Closure $next)
    {
        // Check if application is installed
        if (!File::exists(storage_path('installed'))) {
            return redirect()->route('install.index');
        }

        return $next($request);
    }
}
