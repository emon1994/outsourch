<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerAuthController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.customer-register');
    }

    // public function register(Request $request)
    // {
    //     // This is to ensure all data is being captured correctly.
    //     // dd($request->all());

    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|string|email|max:255|unique:customers',
    //         'mobile' => 'required|string|max:255',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);

    //     $customer = Customer::create([
    //         'name' => $request->name,
    //         'email' => $request->email,
    //         'mobile' => $request->mobile,
    //         'password' => Hash::make($request->password),
    //     ]);

    //     Auth::guard('customer')->login($customer);

    //     return redirect()->route('customer.dashboard');
    // }



    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'mobile' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->mobile = $request->mobile;
        $customer->password = Hash::make($request->password);

        if ($customer->save()) {
            Auth::guard('customer')->login($customer);
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors(['error' => 'Failed to save customer']);
    }

    public function showLoginForm()
    {
        return view('auth.customer-login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('customer')->attempt($request->only('email', 'password'))) {
            return redirect()->route('customer.dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
