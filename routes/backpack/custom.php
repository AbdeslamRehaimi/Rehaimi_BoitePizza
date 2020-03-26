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
    Route::crud('tag', 'TagCrudController');
    Route::crud('articles', 'ArticlesCrudController');
    Route::crud('friends', 'FriendsCrudController');
    Route::crud('memos', 'MemosCrudController');
    Route::crud('catproduit', 'CatproduitCrudController');
    Route::crud('catproduit', 'CatproduitCrudController');
    Route::crud('categoriesproduit', 'CategoriesProduitCrudController');
    Route::crud('categories', 'CategoriesCrudController');
}); // this should be the absolute last line of this file