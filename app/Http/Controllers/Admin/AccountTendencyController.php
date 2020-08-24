<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\AccountTendency;
use App\Model\AccountAnalysis;

class AccountTendencyController extends Controller
{
    public function index()
    {
        return AccountAnalysis::with("tendencies", "class")->paginate(20);//->links();
    }

    public function getAll() 
    {
        // return Account::all();//->links();
    }

    public function count()
    {
        // return Account::count();
    }
}
