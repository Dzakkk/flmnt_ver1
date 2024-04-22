<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function dataSupplier() 
    {
        $supplier = Supplier::all();
        return view('supplier.supplier', ['supplier' => $supplier]);
    }

    public function storeSupplier(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required',
            // 'telephone' => 'required',
            // 'contact_name' => 'required',
            // 'status' => 'required',
            // 'address' => 'required',
            // 'city' => 'required',
            // 'provinces' => 'required',
            // 'postal_code' => 'required',
            // 'country' => 'required',
            // 'email' => 'required',
            // 'note' => 'required',
        ]);

        Supplier::create([
            'supplier_name' => $request->supplier_name,
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
        ]);

        return redirect('/supplier')->with('success', 'Supplier created successfully.');
    }

    public function updateSupplier($id) 
    {
        $Supplier = Supplier::find($id);
        return view('supplier.update', ['supplier' => $Supplier ]);
    }

    public function update(Request $request, $id)
    {
        $data = Supplier::find($id);
        $data->update($request->all());
        return redirect('/supplier')->with('DATA WAS UPDATED');
    }

    public function delete($id)
    {
        $Supplier = Supplier::find($id);
        if (!$Supplier) {
            return redirect('/supplier')->with('error', 'Supplier not found.');
        }
        $Supplier->delete();
        return redirect('/supplier')->with('success', 'Supplier deleted successfully.');
    }
}
