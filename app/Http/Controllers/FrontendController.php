<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class FrontendController extends Controller
{
    public function home($value='')
    {
    	$items = Item::orderBy('id','desc')->take(3)->get();
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
}
