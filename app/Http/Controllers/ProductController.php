<?php

namespace App\Http\Controllers;

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
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('products.create');
    }

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
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        try {


            $product = Product::create($request->all());


            return redirect()->route('home')->with(['success' => 'Product Add successful']);


        }catch (Exception $ex) {

            return redirect()->route('products.index')->with(['error' => 'There is a problem, try later']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product=Product::find($id);
        return view('products.view',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product=Product::find($id);
        return view('products.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator= Validator::make($request->all(),[

            'name' => 'min:1',
            'price' => 'min:1|numeric',

            'description' => 'min:1',



        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInputs($request->all());
        }
        try {

            $product = Product::find($id);
            if (!$product)
                return redirect()->route('products.index')->with(['error' => 'There is a problem, try later']);


            $product->update([

                'price' => $request->price,
                'name' => $request->name,
                'description' => $request->description,

            ]);



            return redirect()->route('products.index')->with(['success' => 'Update Successful']);

        }
        catch (\Exception $ex ){
            return redirect()->route('products.index')->with(['error' => 'There is a problem, try later']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $product=Product::findOrfail($id);
        $product->delete();
        return redirect()->back()->with(['success' => 'Delete Successful']);
    }
}
