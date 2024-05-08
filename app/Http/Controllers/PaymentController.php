<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $payment =Payment::all();
        return $this->sendResponse($payment, 'All Payment See Easily!');
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
            'method' => 'required',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $input = $request->all();
        $payment = Payment::create($input);
        return $this->sendResponse($payment, 'Expense Data Created Successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $payment = Payment::findorFail($id);
        return $this->sendResponse($payment, 'Payment Data Fetched Successfully');
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'method' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $payment = Payment::findorFail($id);
        $payment->update([
            'method' => $request->method
        ]);
        return $this->sendResponse($payment , 'Payment Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $payment = Payment::findorFail($id)->delete();
        return $this->sendResponse($payment , 'Payment Data Deleted Permanently!');
    }
}
