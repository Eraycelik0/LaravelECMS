<?php

namespace App\Http\Middleware;

use App\Models\Pages;
use App\Models\Settings;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class Share
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $data['settings']= Settings::all();

        foreach ($data['settings'] as $key) {
            $settings[$key->settings_key] = $key->settings_value;
        }

        $page = Pages::all()->sortBy('page_must')->first();
        $settings['slug'] = $page['page_slug'];
        View::share($settings);


        return $next($request);
    }
}
