<?php

namespace App\Http\Controllers;

use App\Models\Expense_category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $expense_category = Expense_category::all();
        return $this->sendResponse($expense_category, 'All Expense Category See Easily!');
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $input = $request->all();
        $expense_category = Expense_category::create($input);
        return $this->sendResponse($expense_category, 'Expense Category Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense_category $expense_category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense_category = Expense_category::findorFail($id);
        return $this->sendResponse($expense_category, 'Expense Category Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $excategory = Expense_category::findorFail($id);
        $excategory->update([
            'name' => $request->name
        ]);
        return $this->sendResponse($excategory , 'Expense Category Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $excategory = Expense_category::findorFail($id)->delete();
        return $this->sendResponse($excategory , 'Expense Category Data Deleted Permanently!');
    }
}
