<?php

namespace App\Http\Middleware\Cms;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class QueueMediaStart
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        return $next($request);
    }

    /**
     * Handle tasks after the response has been sent to the browser.
     *
     * @return void
     */
    public function terminate(): void
    {
        Artisan::call('queue:work --queue=media --stop-when-empty');
    }
}
