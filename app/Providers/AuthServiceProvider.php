<?php
declare(strict_types=1);

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use OpenApi\Attributes as OA;

#[OA\SecurityScheme(
    securityScheme: 'petstore_auth',
    type: 'oauth2',
    name: 'petstore_auth',
    flows: [
        new OA\Flow(
            authorizationUrl: 'http://petstore.swagger.io/oauth/dialog',
            flow: 'implicit',
            scopes: [
                'write:pets' => 'modify pets in your account',
                'read:pets' => 'read your pets',
            ]
        ),
    ]
)]
#[OA\SecurityScheme(
    securityScheme: 'ApiKeyAuth',
    type: 'apiKey',
    name: 'X-API-Key',
    in: 'header'
)]
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {

    }
}
