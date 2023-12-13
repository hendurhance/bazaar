<?php

namespace App\Http\Middleware;

use App\Models\Ad;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class IncreaseAdViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Get the ad from the request
        $ad = Ad::where('slug', $request->route('ads'))->first();
        if ($ad) {
            // Increase the ad views
            $ad->increment('views');
        }
        
        return $response;
    }
}
