<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateCategoryController extends Controller
{
    public function __invoke()
    {
        return view('admin.categories.create');
    }
}
