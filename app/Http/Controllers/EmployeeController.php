<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $employee =Employee::with('teamable')->get();
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
            'position' => 'required',
            'joining_date' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required | email',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $employee = Employee::create($request->all());
        $employee->teamable()->create([
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'address' => $request->input('address')
        ]);
        return $this->sendResponse($employee, 'Employee Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $employee = Employee::with('teamable')->findorFail($id);
        return $this->sendResponse($employee, 'Employee Data Fetched Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $employee = Employee::with('teamable')->findorFail($id);
        return $this->sendResponse($employee, 'Employee Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  string $id)
    {
        $validator = Validator::make($request->all(), [
            'position' => 'required',
            'joining_date' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        //$input=$request->all();
        $input['position']=$request->position;
        $input['joining_date']=$request->joining_date;
        $inputTeam['name']=$request->name;
        $inputTeam['phone']=$request->phone;
        $inputTeam['email']=$request->email;
        $inputTeam['address']=$request->address;
        $employee = Employee :: findorFail($id)->update($input);
        $e= Employee :: findorFail($id);
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
       $employee = Employee::findOrFail($id);
        
       // Delete the employee
       $employee->delete();
       
       // Find the related person
       $teamable = $employee->teamable;
       
       // Delete the related teamable
       $teamable->delete();
        return $this->sendResponse($employee , 'Employee Data Deleted Permanently!');
    }
}
