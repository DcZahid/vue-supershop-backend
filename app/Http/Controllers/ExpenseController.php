<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expense =Expense::with('expense_category')->get();
        return $this->sendResponse($expense, 'All Expenses See Easily!');
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
            'expense_category_id' => 'required',
            'amount' => 'required',
            'date' => 'required'
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $input = $request->all();
        $expense = Expense::create($input);
        return $this->sendResponse($expense, 'Expense Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $expense = Expense::findorFail($id);
        return $this->sendResponse($expense, 'Expense Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'expense_category_id' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $expense = Expense::findorFail($id);
        $expense->update([
            'expense_category_id' => $request->expense_category_id,
            'amount' => $request->amount,
            'date' => $request->date
        ]);
        return $this->sendResponse($expense , 'Expense Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $expense = Expense::findorFail($id)->delete();
        return $this->sendResponse($expense , 'Expense Data Deleted Permanently!');
    }
}
