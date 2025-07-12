<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MenuController extends Controller
{

    public function ShowAccountsMenu()
    {
        return view('Admin.accounts.menu');
    }


    public function ShowExtinguishersMenu()
    {
        return view('Admin.extinguisher.menu');
    }
}
