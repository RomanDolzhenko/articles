<?php

namespace App\Providers;

use App\Domain\Article\Models\Article;
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
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        Route::model('articles', Article::class);

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            if(scandir(base_path('app/Domain'))){
                foreach (array_diff(scandir(base_path('app/Domain')), ['..', '.']) as $folderName) {
                    if (file_exists(base_path("app/Domain/$folderName/Routes/route.php"))) {
                        Route::middleware(['web'])
                            ->group(base_path("app/Domain/$folderName/Routes/route.php"));
                    }
                    if (file_exists(base_path("app/Domain/$folderName/Routes/api.php"))) {
                        Route::middleware(['api'])
                            ->prefix('api')
                            ->name('api.')
                            ->group(base_path("app/Domain/$folderName/Routes/api.php"));
                    }
                }
            }
        });
    }
}
