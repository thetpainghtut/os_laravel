<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Order;

class FrontendController extends Controller
{
    public function home($value='')
    {
    	$items = Item::orderBy('id','desc')->take(4)->get();
    	return view('frontend.home',compact('items'));
    }

    // ItemController -> show
    public function itemdetail($item)
    {
    	$item = Item::find($item);
    	return view('frontend.detail',compact('item'));
    }

    public function cart()
    {
    	return view('frontend.cart');
    }

    public function checkout(Request $request)
    {
        $arr = json_decode($request->data);
        $list = $arr->product_list;

        $total = 0;
        foreach($list as $row){
            $subtotal = $row->price*$row->qty;
            $total+=$subtotal;
        }

        $order = new Order;
        $order->orderdate = date('Y-m-d');
        $order->voucherno = uniqid();
        $order->total = $total;
        $order->note= 'Note Here';
        $order->status = 0;
        $order->user_id = 1; // auth id

        $order->save();

        // insert into item_order
        foreach($list as $row){
            $order->items()->attach($row->id,['qty' => $row->qty]);
        }

        return 'Your Order Successful!';
    }
}
