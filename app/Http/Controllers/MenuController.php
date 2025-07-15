<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function ShowDashboard()
    {
        return view('Menu.dashboard');
    }

    public function ShowAdminAccountsMenu()
    {
        return view('Menu.Admin.Accounts');
    }

    public function ShowAdminExtinguishersMenu()
    {
        return view('Menu.Admin.Extinguishers');
    }

    public function ShowAdminInspectionMenu()
    {
        return view('Menu.Admin.Inspections');
    }

    public function ShowMaintenanceExtinguishersMenu()
    {
        return view('Menu.Maintenance.Extinguishers');
    }
}
