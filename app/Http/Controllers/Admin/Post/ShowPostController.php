<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Post;

class ShowPostController extends BaseController
{
    public function __invoke(Post $post)
    {
        return view('admin.posts.show',compact('post'));
    }
}
