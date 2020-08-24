<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\SampleAccount;

class SampleAccountController extends Controller
{
    public function index()
    {
        return SampleAccount::with("posts")->paginate(10);//->links();
        
    }

    public function getAll()
    {
        return SampleAccount::all();//->links();
    }

    public function count()
    {
        return SampleAccount::count();
    }
}
