<?php
declare(strict_types=1);

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use OpenApi\Attributes as OA;

#[OA\SecurityScheme(
    type: 'oauth2',
    name: 'petstore_auth',
    securityScheme: 'petstore_auth',
    flows: [
        new OA\Flow(
            flow: 'implicit',
            authorizationUrl: 'http://petstore.swagger.io/oauth/dialog',
            scopes: [
                'write:pets' => 'modify pets in your account',
                'read:pets' => 'read your pets',
            ]
        ),
    ]
)]
#[OA\SecurityScheme(
    type: 'apiKey',
    in: 'header',
    name: 'api_key',
    securityScheme: 'api_key'
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
