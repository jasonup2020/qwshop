<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 令牌的有效期
        $this->passportConfig();
    }

    /**
     * passportConfig function
     *
     * @return void
     * @Description 令牌的有效期 配置
     * @Author hg <bishashiwo@gmail.com>
     * @Time 2021-09-21
     */
    public function passportConfig()
    {
//        Passport::routes();
        Passport::ignoreRoutes();

        Passport::tokensExpireIn(now()->addDays(7));

        Passport::refreshTokensExpireIn(now()->addDays(14));

        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
}
}
