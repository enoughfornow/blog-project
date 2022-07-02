<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\User;


class ShowUserController extends Controller
{
    public function __invoke(User $user)
    {
        return view('admin.users.show',compact('user'));
    }
}
