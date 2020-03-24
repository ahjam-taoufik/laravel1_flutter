<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;

class ProductController extends Controller
{

    public function index()
    {

        try {
              if(auth()->user()->products->count()>0){
                  $products=auth()->user()->products;
                  return response()->json($products);
              }else{
                  return response()->json(['message'=>'you have not product yet']);
              }
        }catch(\Exception $e){
            return response()->json(["error"=>"no request "]);
        }

    }

   /* public function create()
    {
        //
    }*/

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'price' => 'required|integer'
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->price = $request->price;

        if (auth()->user()->products()->save($product))
            return response()->json('done'
             /*    [
                 'success' => true,
                 'data' => $product->toArray()
             ]*/
            );
        else
            return response()->json('sorry'
                //     [
                //     'success' => false,
                //     'message' => 'Product could not be added'
                // ]
                , 500);
    }
    public function show($id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json('sorry not found', 400);
        }

        return response()->json( [$product->toArray()] , 200);
    }

    public function update(Request $request, $id)
    {
        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json('sorry this product not exist', 400);
        }

        $updated = $product->fill($request->all())->save();

        if ($updated)
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
            );
        else
            return response()->json('sorry  error server'
                //     [
                //     'success' => false,
                //     'message' => 'Product could not be updated'
                // ]
                , 500);
    }


    public function destroy($id)
    {


        $product = auth()->user()->products()->find($id);

        if (!$product) {
            return response()->json('sorry'
                //     [
                //     'success' => false,
                //     'message' => 'Product with id ' . $id . ' not found'
                // ]
                , 400);
        }

        if ($product->delete()) {
            return response()->json('done'
            //     [
            //     'success' => true
            // ]
            );
        } else {
            return response()->json('sorry'
                //     [
                //     'success' => false,
                //     'message' => 'Product could not be deleted'
                // ]
                , 500);
        }
    }
}
