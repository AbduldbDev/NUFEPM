<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function ShowLocations()
    {
        return view('Admin.locations.alllocations');
    }
}
