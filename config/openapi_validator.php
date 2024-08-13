<?php
declare(strict_types=1);

/*
 * Laravel OpenAPI Validator Config
 */
return [
    /*
    |--------------------------------------------------------------------------
    | OpenAPI path
    |--------------------------------------------------------------------------
    |
    | This is the path to the OpenAPI spec (likely openapi.yaml, openapi.yml, or
    | openapi.json).
    |
    */
    'spec_path' => env('OPENAPI_PATH', base_path('storage/api-docs/api-docs.json')),
];
