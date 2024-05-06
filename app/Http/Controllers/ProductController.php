<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $subcategory =Product::with('category','brand','sub_category')->get();
        return $this->sendResponse($subcategory, 'All Employee See Easily!');
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
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'name' => 'required'
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $input = $request->all();
        $subcategory =Product::create($input);
        return $this->sendResponse($subcategory, 'Subcategory Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $subcategory = Product::findorFail($id);
        return $this->sendResponse($subcategory, 'Category Data Fetched Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
        $subcategory = Product::findorFail($id);
        return $this->sendResponse($subcategory, 'Category Data Fetched Successfully');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'category_id' => 'required',
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $subcategory = Product::findorFail($id);
        $subcategory->update([
            'category_id' => $request->category_id,
            'sub_category_id' => $request->sub_category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name
        ]);
        return $this->sendResponse($subcategory , 'SubCategory Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $subCategory = Product::findorFail($id)->delete();
        return $this->sendResponse($subCategory , 'SubCategory Data Deleted Permanently!');
    }
}
