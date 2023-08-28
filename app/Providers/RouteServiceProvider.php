<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));

            // 设置分离路由 : 移动端如果存在路由文件则执行
            if(file_exists(app_path('Qingwuit/wap.php'))){
                Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(app_path('Qingwuit/wap.php'));
            }
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(app_path('Qingwuit/api.php'));
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(app_path('Qingwuit/route.php'));
        });
    }
}
