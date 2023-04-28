<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    public function index()
    {
        $product=Product::all();
        if($product->count() > 0)
        {
            return response()->json(
                [
                    'status'=>200,
                     'products'=>$product
                ],200);
        }
        else
        {
            return response()->json(
                [
                    'status'=>404,
                     'message'=>'No Records Found'
                ],404);
        }
        
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'items' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required|string|max:191'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422); 
        }
        else
        {
            $product=Product::create([
                'name' =>  $request->name,
                'items' => $request->items,
                'discount' => $request->discount,
                'description' => $request->description,

            ]);

            if($product)
            {
                return response()->json([
                    'status' => 200,
                    'message' => "Product created successfully"

                ],200);
            }
            else
            {
                return response()->json([
                    'status' => 500,
                    'message' => "Something went wrong!"
                ],500);

            }
        }
    }
    public function show($id)
    {
        $product=Product::find($id);
        if($product)
        {
            return response()->json([
                'status' => 200,
                'products' => $product
            ],200);

        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => "No Such Product found!"
            ],404);

        }
    }
    public function edit($id)
    {
        $product=Product::find($id);
        if($product)
        {
            return response()->json([
                'status' => 200,
                'product' => $product
            ],200);

        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => "No Such Product found!"
            ],404);

        }

    }

    public function update(Request $request,int $id)
    {

        
        $validator=Validator::make($request->all(),[
            'name' => 'required|string|max:191',
            'items' => 'required|numeric',
            'discount' => 'required|numeric',
            'description' => 'required|string|max:191'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422); 
        }
        else
        {
            $product=Product::find($id);
            if($product)
            {
                $product->update([
                    'name' =>  $request->name,
                    'items' => $request->items,
                    'discount' => $request->discount,
                    'description' => $request->description,
    
                ]);    
                return response()->json([
                    'status' => 200,
                    'message' => "Product Updated successfully"

                ],200);
            }
            else
            {
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Product Found!"
                ],500);

            }
        }

       
    }

    public function destroy(int $id)
    {
          $product=Product::find($id);
          if($product)
          {
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => "Product deleted Sucessfully!"
            ],200);    

          }
          else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Product Found!"
            ],500);            
          }

       
    }
}
