<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Order_details;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Order::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $maxid = \DB::table('orders')->get();
       if(count($maxid)>1){
        $orderid = \DB::table('orders')->max("id");
       }
       else{
        $orderid = 0;
       }

        $this->validate($request, [
            'name'=>'required|string|max:191',
            'amount'=>'required|'
        ]);
        $products = \DB::table("products")->get();
        foreach($products as $product){
            if($product->name == $request["product"]){
                $id = $product->id;
            }
        }
        Order_details::create([
            'product_id' => $id,
            'order_id' =>   $orderid,
        ]);
        return Order::create([
            'name'=>$request['name'],
            'amount'=>$request['amount'],
            'order_number'=>  $orderid
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
        $order = Order::find($id);
        $this->validate($request, [
            'name'=>'required|string|max:191',
            'amount'=>'required|'
        ]);
        $order->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        $order->delete();
    }
}
