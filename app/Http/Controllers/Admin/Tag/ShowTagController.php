<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Tag;

class ShowTagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        return view('admin.tags.show',compact('tag'));
    }
}
