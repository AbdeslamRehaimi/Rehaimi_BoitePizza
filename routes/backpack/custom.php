<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('categories', 'CategoriesCrudController');
    Route::crud('products', 'ProductsCrudController');
    Route::crud('clients', 'ClientsCrudController');
    Route::crud('commentaires', 'CommentairesCrudController');
    Route::crud('formules', 'FormulesCrudController');
    Route::crud('commands', 'CommandsCrudController');
 }); // this should be the absolute last line of this file
