<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Traits\CommonTrait;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    use CommonTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('transactions')->withSum('transactions', 'amount')->get();
        return $this->sendResponse(['data' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validated = $request->validate([
            'full_name' => 'required|max:255',
            'age' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
 
        $customer = Customer::create($validated);

        return $this->sendResponse(['data' => $customer, 'message' => 'Customer created successfully']);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $customer = Customer::find($id);
        return $this->sendResponse(['data' => $customer]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'full_name' => 'required|max:255',
            'age' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);
 
        $customer = Customer::find($id);
        $customer->full_name = $validated['full_name'];
        $customer->age = $validated['age'];
        $customer->email = $validated['email'];
        $customer->phone = $validated['phone'];
        $customer->save();

        return $this->sendResponse(['data' => $customer, 'message' => 'Customer updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Customer::destroy($id);

        return $this->sendResponse(['message' => 'Deleted Successfully']);
    }
}
