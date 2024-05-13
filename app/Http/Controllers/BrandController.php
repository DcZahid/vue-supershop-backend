<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $brand =Brand::all();
        return $this->sendResponse($brand, 'All Employee See Easily!');
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
            'name' => 'required',
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        // $data = $request->all();
        $input = $request->all();
        $brand = Brand::create($input);
        return $this->sendResponse($brand, 'Expense Data Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $brand =Brand::with('teamable')->find($id);
        return $this->sendResponse($brand, 'All Employee See Easily!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand =Brand::with('teamable')->find($id);
        return $this->sendResponse($brand, 'All Employee See Easily!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors(), 422);
        }

        $brand = Brand::findorFail($id);
        $brand->update([
            'name' => $request->name
        ]);
        return $this->sendResponse($brand , 'brand Data Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $brand = Brand::findorFail($id)->delete();
        return $this->sendResponse($brand , 'Category Data Deleted Permanently!');
    }
}
