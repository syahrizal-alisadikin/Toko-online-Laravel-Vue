<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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


        //Login
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // Forgot Password
        Fortify::requestPasswordResetLinkView(function () {
            return view('auth.forgot-password');
        });

        //Reset Password
        Fortify::resetPasswordView(function ($request) {
            return view('auth.reset-password', ['request' => $request]);
        });

        // Confirm Password
        Fortify::confirmPasswordView(function () {
            return view('auth.confirm-password');
        });

        // Two Faktor Authentication
        Fortify::twoFactorChallengeView(function () {
            return view('auth.two-faktor-challenge');
        });
    }
}
