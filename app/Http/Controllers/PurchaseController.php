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
        $purchase= Purchase::with('payment','supplier.teamable','product.category','product.sub_category','product.brand','unit')->get();
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
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}
