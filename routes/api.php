<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Donor
    Route::apiResource('donors', 'DonorApiController');

    // Theme
    Route::apiResource('themes', 'ThemeApiController');

    // Fund
    Route::apiResource('funds', 'FundApiController');

    // Project
    Route::apiResource('projects', 'ProjectApiController');
});
