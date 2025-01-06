<?php

Route::group(['middleware' => ['web']], function () {
    Route::prefix('mpesa')->group(function () {
        Route::get('/process', 'Webkul\Mpesa\Http\Controllers\MpesaController@process')->name('mpesa.process');
        Route::post('/callback', 'Webkul\Mpesa\Http\Controllers\MpesaController@callback')->name('mpesa.callback');
    });
});