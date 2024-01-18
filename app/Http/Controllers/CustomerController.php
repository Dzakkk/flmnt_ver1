<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function dataCustomer() 
    {
        $Customer = Customer::all();
        return view('customer.customer', ['customer' => $Customer]);
    }

    public function storeCustomer(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'telephone' => 'required',
            'contact_name' => 'required',
            'status' => 'required',
            'address' => 'required',
            'city' => 'required',
            'provinces' => 'required',
            'postal_code' => 'required',
            'country' => 'required',
            'email' => 'required',
            'note' => 'required',
            'sales_name' => 'required',
        ]);

        Customer::create([
            'customer_name' => $request->customer_name,
            'telephone' => $request->telephone,
            'contact_name' => $request->contact_name,
            'status' => $request->status,
            'address' => $request->address,
            'city' => $request->city,
            'provinces' => $request->provinces,
            'postal_code' => $request->postal_code,
            'country' => $request->country,
            'email' => $request->email,
            'note' => $request->note,
            'sales_name' => $request->sales_name
        ]);

        return redirect('/customer')->with('success', 'Customer created successfully.');
    }

    public function updateCustomer($id) 
    {
        $Customer = Customer::find($id);
        return view('customer.update', ['customer' => $Customer ]);
    }

    public function update(Request $request, $id)
    {
        $data = Customer::find($id);
        $data->update($request->all());
        return redirect('/customer')->with('DATA WAS UPDATED');
    }

    public function delete($id)
    {
        $Customer = Customer::find($id);
        if (!$Customer) {
            return redirect('/customer')->with('error', 'Customer not found.');
        }
        $Customer->deleteCustomer();
        return redirect('/customer')->with('success', 'Customer deleted successfully.');
    }
}
