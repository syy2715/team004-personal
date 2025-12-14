<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Item;

class ItemController extends Controller
{
    public function create(Request $request){
       return view('item');
    }

    public function store(Request $request){
        return redirect('/item');
    }
}