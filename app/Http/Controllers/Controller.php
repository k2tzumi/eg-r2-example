<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Attributes as OA;

#[OA\Info(
    version: '1.0.0',
    description: 'This is a sample Petstore server. You can find out more about Swagger at [http://swagger.io](http://swagger.io) or on [irc.freenode.net, #swagger](http://swagger.io/irc/).',
    title: 'Swagger Petstore',
    termsOfService: 'http://swagger.io/terms/',
    contact: new OA\Contact(
        email: 'apiteam@swagger.io'
    ),
    license: new OA\License(
        name: 'Apache 2.0',
        url: 'http://www.apache.org/licenses/LICENSE-2.0.html'
    )
)]
#[
    OA\Tag(
        name: 'pet',
        description: 'Everything about your Pets'
    ),
    OA\Tag(
        name: 'store',
        description: 'Access to Petstore orders'
    ),
    OA\Tag(
        name: 'user',
        description: 'Operations about user'
    )
]
#[
    OA\Server(
        url: 'http://127.0.0.1:8000/api',
        description: 'Laravel built-in server'
    ),
    OA\Server(
        url: 'https://virtserver.swaggerhub.com/swagger/Petstore/1.0.0',
        description: 'SwaggerHUB API Mocking'
    )
]
#[OA\ExternalDocumentation(
    description: 'Find out more about Swagger',
    url: 'http://swagger.io'
)]
class Controller extends BaseController
{
    use AuthorizesRequests;
    use ValidatesRequests;
}
