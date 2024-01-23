<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    public function dataManufacturer() 
    {
        $manufacturer = Manufacturer::all();
        return view('manufacturer.manufacturer', ['manufacturer' => $manufacturer]);
    }

    public function formManufacturer()
    {
        return view('manufacturer.form');
    }

    public function storeManufacturer(Request $request)
    {
        $request->validate([
            'manufacturer_name' => 'required',
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
        ]);

        Manufacturer::create([
            'manufacturer_name' => $request->manufacturer_name,
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

        return redirect('/manufacturer')->with('success', 'Manufacturer created successfully.');
    }

    public function updateManufacturer($id) 
    {
        $manufacturer = Manufacturer::find($id);
        return view('manufacturer.update', ['manufacturer' => $manufacturer ]);
    }

    public function update(Request $request, $id)
    {
        $data = Manufacturer::find($id);
        $data->update($request->all());
        return redirect('/manufacturer')->with('DATA WAS UPDATED');
    }

    public function delete($id)
    {
        $Manufacturer = Manufacturer::find($id);
        if (!$Manufacturer) {
            return redirect('/manufacturer')->with('error', 'Manufacturer not found.');
        }
        $Manufacturer->delete();
        return redirect('/manufacturer')->with('success', 'Manufacturer deleted successfully.');
    }
}