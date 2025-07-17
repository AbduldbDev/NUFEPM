<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExtinguisherRefill;

class RefillLogsController extends Controller
{
    public function ShowAllRefills()
    {
        $items = ExtinguisherRefill::with(['user', 'extinguisher'])->latest()->paginate(50);
        return view('Admin.refill.logstable', compact('items'));
    }
}
