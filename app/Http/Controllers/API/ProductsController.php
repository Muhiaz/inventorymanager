<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Product::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string|max:191',
            'description'=>'required|string|max:191',
            'price'=>'required|string|max:191',
            'supplier'=>'required|string|max:191',
            
        ]);
        $suppliers = \DB::table("users")->get();
        foreach($suppliers as $supplier){
            if($supplier->name == $request['supplier']){
                $name = $supplier->name;
            }
        }
        return Product::create([
            'name'=>$request['name'],
            'description'=>$request['description'],
            'price'=>$request['price'],
            'supplier'=>$name,
            'quantity'=>$request['quantity'],
            'category'=>$request['category']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $product = Product::find($id);
        $this->validate($request, [
            'name'=>'required|string|max:191',
            'description'=>'required|string|max:191',
            'price'=>'required|string|max:191',
            'supplier'=>'required|string|max:191',
            
        ]);
        $product->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
    }
}
