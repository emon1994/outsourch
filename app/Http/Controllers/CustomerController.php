<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dashboard()
    {
    
        return view('customer.dashboard');
    }
}
