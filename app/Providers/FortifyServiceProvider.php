<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgenciaController;
use App\Http\Controllers\MarcaController;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\Admin\AdminAttemptToAuthenticate;
use App\Actions\Fortify\Admin\AdminRedirectIfTwoFactorAuthenticatable;
use App\Actions\Fortify\Agencia\AgenciaAttemptToAuthenticate;
use App\Actions\Fortify\Agencia\AgenciaRedirectIfTwoFactorAuthenticatable;
use App\Actions\Fortify\Marca\MarcaAttemptToAuthenticate;
use App\Actions\Fortify\Marca\MarcaRedirectIfTwoFactorAuthenticatable;
use Auth;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->when([AdminController::class, AdminAttemptToAuthenticate::class, AdminRedirectIfTwoFactorAuthenticatable::class])
            ->needs(StatefulGuard::class)
            ->give(function(){
                return Auth::guard('admin');
            });

            $this->app->when([AgenciaController::class, AgenciaAttemptToAuthenticate::class, AgenciaRedirectIfTwoFactorAuthenticatable::class])
            ->needs(StatefulGuard::class)
            ->give(function(){
                return Auth::guard('agencia');
            });

            $this->app->when([MarcaController::class, MarcaAttemptToAuthenticate::class, MarcaRedirectIfTwoFactorAuthenticatable::class])
            ->needs(StatefulGuard::class)
            ->give(function(){
                return Auth::guard('marca');
            });

    }


    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->email;

            return Limit::perMinute(5)->by($email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
