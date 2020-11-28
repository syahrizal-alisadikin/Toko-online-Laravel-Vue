<?php

namespace App\Http\Controllers\Admin;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->when(request()->q, function ($customers) {
            $customers = $customers->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.customer.index', compact('customers'));
    }
}
