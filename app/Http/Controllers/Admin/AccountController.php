<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Account;

class AccountController extends Controller
{
    public function index()
    {
        return Account::with("posts")->paginate(10);//->links();
        
    }

    public function getAll()
    {
        return Account::all();//->links();
    }

    public function count()
    {
        return Account::count();
    }
}
