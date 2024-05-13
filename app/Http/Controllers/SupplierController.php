<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employee =Supplier::with('teamable')->get();
        return $this->sendResponse($employee, 'All Employee See Easily!');
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
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required | email',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $supplier = Supplier::create($request->all());
        $supplier->teamable()->create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address')
        ]);
        return $this->sendResponse($supplier, 'Employee Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $supplier = Supplier::with('teamable')->findorFail($id);
        return $this->sendResponse($supplier, 'supplier Data Fetched Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $supplier = Supplier::with('teamable')->findorFail($id);
        return $this->sendResponse($supplier, 'supplier Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'company_name' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        //$input=$request->all();
        $input['compane_name']=$request->compane_name;
        $inputTeam['name']=$request->name;
        $inputTeam['phone']=$request->phone;
        $inputTeam['email']=$request->email;
        $inputTeam['address']=$request->address;
        $employee = Supplier :: findorFail($id)->update($input);
        $e= Supplier :: findorFail($id);
        if($inputTeam){
        $e->teamable->update($inputTeam);
        }
        return $this->sendResponse($employee , 'Employee Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Find the employee by ID
       $supplier = Supplier::findOrFail($id);
        
       // Delete the supplier
       $supplier->delete();
       
       // Find the related person
       $teamable = $supplier->teamable;
       
       // Delete the related teamable
       $teamable->delete();
        return $this->sendResponse($supplier , 'Employee Data Deleted Permanently!');
    }
}
