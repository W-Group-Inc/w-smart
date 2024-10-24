<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoutesController extends Controller
{
    public function settingsRoles()
    {
        return view('settings_role');
    }

    public function inventoryList()
    {
        return view('inventory_list');
    }

    public function inventoryTransfer()
    {
        return view('inventory_transfer');
    }

    public function inventoryWithdrawal()
    {
        return view('inventory_withdrawal');
    }

    public function inventoryReturned()
    {
        return view('inventory_returned');
    }
    public function category()
    {
        return view('category');
    }
}
