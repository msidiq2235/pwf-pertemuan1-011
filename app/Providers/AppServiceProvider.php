<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 1. Gate bawaan untuk web (Jangan dihapus)
        Gate::define('manage-product', function (User $user) {
            return $user->role === 'admin';
        });
        
        Gate::define('manage-category', function (User $user) {
            return $user->role === 'admin'; 
        });

        // 2. Filter rute yang dibaca Scramble (hanya rute yang berawalan 'api/')
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            });

        // 3. Buka gerbang akses halaman dokumentasi Scramble untuk publik
        Gate::define('viewApiDocs', function (?User $user) {
            return true; 
        });

        // 4. INI YANG PALING PENTING: Memunculkan tombol Token (Bearer) di Scramble
        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::http('bearer')
            );
        });
    }
}