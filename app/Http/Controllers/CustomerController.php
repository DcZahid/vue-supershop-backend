<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\People;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers =Customer::with('teamable')->get();
        return $this->sendResponse($customers, 'All Customer See Easily!');
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
        //
        $validator = validator::make($request->all(), [
            'customer_type' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $customer = Customer::create($request->all());
        $customer->teamable()->create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address')
        ]);
        return $this->sendResponse($customer, 'customer Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $customer = Customer::with('teamable')->findorFail($id);
        return $this->sendResponse($customer, 'Customer Data Fetched Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $customer = Customer::with('teamable')->findorFail($id);
        return $this->sendResponse($customer, 'Customer Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'customer_type' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        //$input=$request->all();
        $input['customer_type']=$request->customer_type;
        $inputTeam['name']=$request->name;
        $inputTeam['phone']=$request->phone;
        $inputTeam['email']=$request->email;
        $inputTeam['address']=$request->address;
        $employee = Customer :: findorFail($id)->update($input);
        $e= Customer :: findorFail($id);
        if($inputTeam){
        $e->teamable->update($inputTeam);
        }
        return $this->sendResponse($employee , 'Employee Data Updated Successfully!');


        // $validator = Validator::make($request->all(), [
        //     'customer_type' => 'required',
        //     'name' => 'required',
        //     'phone' => 'required',
        //     'email' => 'required | email',
        //     'address' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors(), 422);
        // }
        
        // $customer = Customer::findorFail($id);
        // $customer->update(['customer_type' => $request->customer_type]);

        // $pid = $request->pid;
        // $people = People::findorFail($pid);

        // $people->update([
        //     'name' => $request->name,
        //     'phone' => $request->phone,
        //     'email' => $request->email,
        //     'address' => $request->address
        // ]);

        // $data = [
        //     'customer' => $customer,
        //     'people' => $people
        // ];

        // return $this->sendResponse($data , 'Customer Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $customer = Customer::findorFail($id)->delete();
        return $this->sendResponse($customer , 'Customer Data Deleted Permanently!');
    }
}
