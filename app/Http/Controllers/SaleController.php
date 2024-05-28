<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SaleController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $sale= Sale::with('category','sub_category','brand','product','payment','customer.teamable','unit','purchase')->get();
        return $this->sendResponse($sale,'All sale Data See Easily');
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
            'invoice_id' => 'required',
            'customer_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'product_id' => 'required',
            'unit_id' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'payment_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $input=$request->all();
        $sale=Sale::create($input);
        return $this->sendResponse($sale, 'Sale Data Created Successfully');
    }
    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sale = Sale::findorFail($id);
        return $this->sendResponse($sale, 'sale Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'invoice_id' => 'required',
            'customer_id' => 'required',
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'brand_id' => 'required',
            'product_id' => 'required',
            'unit_id' => 'required',
            'sale_price' => 'required',
            'quantity' => 'required',
            'payment_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }
        $input=$request->all();
        $sale = Sale :: findorFail($id)->update($input);
        return $this->sendResponse($sale , 'sale Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sale = Sale::findorFail($id)->delete();
        return $this->sendResponse($sale , 'sale Data Deleted Permanently!');
    }
}
