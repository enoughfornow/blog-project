<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\Main\IndexController;
use App\Http\Controllers\Admin\Main\AdminController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Category\CreateCategoryController;
use App\Http\Controllers\Admin\Category\StoreCategoryController;
use App\Http\Controllers\Admin\Category\ShowCategoryController;
use App\Http\Controllers\Admin\Category\EditCategoryController;
use App\Http\Controllers\Admin\Category\UpdateCategoryController;
use App\Http\Controllers\Admin\Category\DeleteCategoryController;

use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\Tag\CreateTagController;
use App\Http\Controllers\Admin\Tag\StoreTagController;
use App\Http\Controllers\Admin\Tag\ShowTagController;
use App\Http\Controllers\Admin\Tag\EditTagController;
use App\Http\Controllers\Admin\Tag\UpdateTagController;
use App\Http\Controllers\Admin\Tag\DeleteTagController;

use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Post\CreatePostController;
use App\Http\Controllers\Admin\Post\StorePostController;
use App\Http\Controllers\Admin\Post\ShowPostController;
use App\Http\Controllers\Admin\Post\EditPostController;
use App\Http\Controllers\Admin\Post\UpdatePostController;
use App\Http\Controllers\Admin\Post\DeletePostController;

use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\User\CreateUserController;
use App\Http\Controllers\Admin\User\StoreUserController;
use App\Http\Controllers\Admin\User\ShowUserController;
use App\Http\Controllers\Admin\User\EditUserController;
use App\Http\Controllers\Admin\User\UpdateUserController;
use App\Http\Controllers\Admin\User\DeleteUserController;

use App\Http\Controllers\Personal\Main\PersonalController;

use App\Http\Controllers\Personal\Comment\PersonalCommentController;
use App\Http\Controllers\Personal\Comment\PersonalUpdateCommentController;
use App\Http\Controllers\Personal\Comment\PersonalEditCommentController;
use App\Http\Controllers\Personal\Comment\PersonalDeleteCommentController;

use App\Http\Controllers\Personal\Liked\PersonalLikedController;
use App\Http\Controllers\Personal\Liked\PersonalDeleteLikedController;

use App\Http\Controllers\Post\PostIndexController;
use App\Http\Controllers\Post\PostShowController;

use App\Http\Controllers\Post\Comment\StoreCommentController;

use App\Http\Controllers\Category\IndexCategoryController;
use App\Http\Controllers\Category\Post\PostCategoryIndexController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

    Route::group(['namespace' => 'App\Http\Controllers\Main'], function () {

    Route::get('/', IndexController::class)->name('main.index');

});

    Route::group(['namespace' => 'App\Http\Controllers\Post', 'prefix' => 'posts'], function () {

    Route::get('/', PostIndexController::class)->name('post.index');
    Route::get('/{post}', PostShowController::class)->name('post.show');

// post/10/comments (nasted route)

    Route::group(['namespace'=>'Comment','prefix'=>'{post}/comments'], function() {
        Route::post('/', StoreCommentController::class)->name('post.comment.store');
    });

    Route::group(['namespace'=>'Like','prefix'=>'{post}/likes'], function() {
        Route::post('/', StoreLikeController::class)->name('post.like.store');
    });

});
    Route::group(['namespace' => 'App\Http\Controllers\Category', 'prefix'=>'categories'], function () {
        Route::get('/', IndexCategoryController::class)->name('category.index');

    Route::group(['namespace'=>'Post','prefix'=>'{category}/posts'], function() {
            Route::get('/', PostCategoryIndexController::class)->name('category.post.index');
        });
    });

    Route::group(['namespace' => 'Personal', 'prefix' => 'personal','middleware'=>['auth','verified']], function () {

    Route::group(['namespace' => 'Personal\Main', 'prefix'=> 'main'], function () {
        Route::get('/', [PersonalController::class, '__invoke'])->name('personal.main.index');   
    });
    Route::group(['namespace' => 'Personal\Liked', 'prefix'=> 'likeds'], function () {
        Route::get('/', [PersonalLikedController::class, '__invoke'])->name('personal.liked.index');   
        Route::delete('/{post}', [PersonalDeleteLikedController::class, '__invoke'])->name('personal.liked.delete');   
    });
    Route::group(['namespace' => 'Personal\Comment', 'prefix'=> 'comments'], function () {
        Route::get('/', [PersonalCommentController::class, '__invoke'])->name('personal.comment.index');   
        Route::get('/{comment}/edit', [PersonalEditCommentController::class, '__invoke'])->name('personal.comment.edit');   
        Route::patch('/{comment}', [PersonalUpdateCommentController::class, '__invoke'])->name('personal.comment.update');   
        Route::delete('/{comment}', [PersonalDeleteCommentController::class, '__invoke'])->name('personal.comment.delete');   
    });
});

    Route::group(['namespace' => 'Admin', 'prefix' => 'admin','middleware'=>['auth','admin','verified']], function () {

    Route::group(['namespace' => 'Admin\Main'], function () {

        Route::get('/', [AdminController::class, '__invoke'])->name('admin.main.index');

    });

    Route::group(['namespace' => 'Admin\Category', 'prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, '__invoke'])->name('admin.category.index');
        Route::get('/create', [CreateCategoryController::class, '__invoke'])->name('admin.category.create');
        Route::post('/', [StoreCategoryController::class, '__invoke'])->name('admin.category.store');
        Route::get('/{category}', [ShowCategoryController::class, '__invoke'])->name('admin.category.show');
        Route::get('/{category}/edit', [EditCategoryController::class, '__invoke'])->name('admin.category.edit');
        Route::patch('/{category}', [UpdateCategoryController::class, '__invoke'])->name('admin.category.update');
        Route::delete('/{category}', [DeleteCategoryController::class, '__invoke'])->name('admin.category.delete');
    });
    Route::group(['namespace' => 'Admin\Tag', 'prefix' => 'tags'], function () {
        Route::get('/', [TagController::class, '__invoke'])->name('admin.tag.index');
        Route::get('/create', [CreateTagController::class, '__invoke'])->name('admin.tag.create');
        Route::post('/', [StoreTagController::class, '__invoke'])->name('admin.tag.store');
        Route::get('/{tag}', [ShowTagController::class, '__invoke'])->name('admin.tag.show');
        Route::get('/{tag}/edit', [EditTagController::class, '__invoke'])->name('admin.tag.edit');
        Route::patch('/{tag}', [UpdateTagController::class, '__invoke'])->name('admin.tag.update');
        Route::delete('/{tag}', [DeleteTagController::class, '__invoke'])->name('admin.tag.delete');
    });
    Route::group(['namespace' => 'Admin\Post', 'prefix' => 'posts'], function () {
        Route::get('/', [PostController::class, '__invoke'])->name('admin.post.index');
        Route::get('/create', [CreatePostController::class, '__invoke'])->name('admin.post.create');
        Route::post('/', [StorePostController::class, '__invoke'])->name('admin.post.store');
        Route::get('/{post}', [ShowPostController::class, '__invoke'])->name('admin.post.show');
        Route::get('/{post}/edit', [EditPostController::class, '__invoke'])->name('admin.post.edit');
        Route::patch('/{post}', [UpdatePostController::class, '__invoke'])->name('admin.post.update');
        Route::delete('/{post}', [DeletePostController::class, '__invoke'])->name('admin.post.delete');
    });
    Route::group(['namespace' => 'Admin\User', 'prefix' => 'users'], function () {
        Route::get('/', [UserController::class, '__invoke'])->name('admin.user.index');
        Route::get('/create', [CreateUserController::class, '__invoke'])->name('admin.user.create');
        Route::post('/', [StoreUserController::class, '__invoke'])->name('admin.user.store');
        Route::get('/{user}', [ShowUserController::class, '__invoke'])->name('admin.user.show');
        Route::get('/{user}/edit', [EditUserController::class, '__invoke'])->name('admin.user.edit');
        Route::patch('/{user}', [UpdateUserController::class, '__invoke'])->name('admin.user.update');
        Route::delete('/{user}', [DeleteUserController::class, '__invoke'])->name('admin.user.delete');
    });
});



Auth::routes(['verify'=>true]);
