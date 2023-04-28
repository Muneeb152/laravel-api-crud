<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
      public function index()
      {
          $products=Products::all();

          if($products->count() > 0)
          {
              return response()->json(
                  [
                      'status'=>200,
                       'students'=>$products
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
            $products=Products::create([
                  'name' =>  $request->name,
                  'items' => $request->items,
                  'discount' => $request->discount,
                  'description' => $request->description,
  
              ]);
  
              if($products)
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
        $products=Products::find($id);
          if($products)
          {
              return response()->json([
                  'status' => 200,
                  'student' => $products
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
        $products=Products::find($id);
          if($products)
          {
              return response()->json([
                  'status' => 200,
                  'student' => $products
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
            $products=Products::find($id);
              if($products)
              {
                $products->update([
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
        $products=Products::find($id);
            if($products)
            {
                $products->delete();
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
