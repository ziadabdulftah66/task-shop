<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->middleware('can:add_product', ['only' => ['create','store']]);
        $this->middleware('can:edit_product', ['only' => ['edit','update']]);
        $this->middleware('can:delete_product', ['only' => ['destroy']]);
        $this->middleware('can:show_product', ['only' => ['show']]);
    }
    public function index()
    {


        $products=Product::get();
        $response=[
            'success'=>true,
            'products'=>$products,


            'message'=>'Products'
        ];
        return response()->json($response,200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'numeric',
            'description' => 'required',


        ]);
        if ($validator->fails()) {
            $response=[
                'success'=>false,



                'message'=>$validator->errors()->first()
            ];
            return response()->json($response,200);

        }
        try {


            $product = Product::create($request->all());

            $response=[
                'success'=>true,



                'message'=>'Product create successful'
            ];
            return response()->json($response,200);



        }catch (Exception $ex) {

            $response=[
                'success'=>false,



                'message'=>'there is problem'
            ];
            return response()->json($response,200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|exists:products,id',
        ]);
        if ($validator->fails()) {
            $response=[
                'success'=>false,
                'message'=>$validator->errors()->first()
            ];
            return response()->json($response,200);

        }
        $product=Product::find($request->id);
        $response=[
            'success'=>true,
            'product'=>$product,



            'message'=>'Product'
        ];
        return response()->json($response,200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'id' => 'required|exists:products,id',
            'name' => 'min:1',
            'price' => 'min:1|numeric',

            'description' => 'min:1',



        ]);
        if($validator->fails()){
            $response=[
                'success'=>false,



                'message'=>$validator->errors()->first()
            ];
            return response()->json($response,200);
        }
        try {

            $product = Product::find($request->id);
            if (!$product) {
                $response = [
                    'success' => false,


                    'message' => 'product not found'
                ];
                return response()->json($response, 200);
            }


            $product->update([
                'price' => $request->price,
                'name' => $request->name,
                'description' => $request->description,

            ]);

            $response=[
                'success'=>true,



                'message'=>'Product Update Successful'
            ];
            return response()->json($response,200);



        }
        catch (\Exception $ex ){

            $response=[
                'success'=>false,



                'message'=>'there is problem'
            ];
            return response()->json($response,200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $validator= Validator::make($request->all(),[
            'id' => 'required|exists:products,id',




        ]);
        if($validator->fails()){
            $response=[
                'success'=>false,

                'message'=>$validator->errors()->first()
            ];
            return response()->json($response,200);
        }
        $product=Product::findOrfail($request->id);
        $product->delete();
        $response=[
            'success'=>true,



            'message'=>'product delete success'
        ];
        return response()->json($response,200);
    }
}
