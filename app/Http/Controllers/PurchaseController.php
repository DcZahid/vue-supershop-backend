<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PurchaseController extends Controller
{
    use ApiResponse;
    public function index()
    {
        //
        $purchase= Purchase::with('payment','supplier.teamable','category','sub_category','product','brand','unit')->get();
        return $this->sendResponse($purchase,'All purchase Data See Easily');
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        //
        $validator = validator::make($request->all(), [
            'invoice_id' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'product_id' => 'required',
            'unit_id' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'payment_id' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $input=$request->all();
        $purchase=Purchase::create($input);
        return $this->sendResponse($purchase, 'purchase Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::findorFail($id);
        return $this->sendResponse($purchase, 'purchase Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,string $id)
    {
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required',
            'supplier_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'product_id' => 'required',
            'unit_id' => 'required',
            'price' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'payment_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        $input=$request->all();
        $employee = Purchase :: findorFail($id)->update($input);
        return $this->sendResponse($employee , 'Employee Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findorFail($id)->delete();
        return $this->sendResponse($purchase , 'Purchase Data Deleted Permanently!');
    }
}
