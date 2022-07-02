<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();
        return view('admin.categories.index',compact('categories')); //compact метод делает доступными данные для blade файлов
    }
}
