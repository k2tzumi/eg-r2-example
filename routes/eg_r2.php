<?php

/**
 * This file is auto-generated.
 */

declare(strict_types=1);

Route::as('api')->group(static function (): void {
    Route::controller('App\Http\Controllers\Pet')->group(static function (): void {
        Route::post('/pet', 'addPet');
        Route::put('/pet', 'updatePet');
        Route::get('/pet/findByStatus', 'findPetsByStatus');
        Route::post('/pet/{petId}', 'updatePetWithForm');
        Route::delete('/pet/{petId}', 'deletePet');
        Route::post('/pet/{petId}/uploadImage', 'uploadFile');
    });
});
