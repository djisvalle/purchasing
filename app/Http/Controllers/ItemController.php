<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Item;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    
    public function index(){

        $items = Item::all();

        return view("maintenance.maintenance-item")->with('items', $items);
    }

    public function store(Request $request)
    {        
        $item = Item::create(array(
                'item_name' => trim($request->input('add-item-name')),
                'item_description' => trim($request->input('add-item-description')),
                'unit_cost' => $request->input('add-item-cost'),
                'is_active' => 1
            ));

        $added = $item->save();

        return redirect('maintenance/item');
    }

    public function update(Request $request)
    {

        $item = Item::find($request->input('edit-item-id'));

        $item->item_name = trim($request->input('edit-item-name'));
        $item->item_description = trim($request->input('edit-item-description'));
        $item->unit_cost = $request->input('edit-item-cost');
        $item->save();

        return redirect('maintenance/item');
    }

    public function delete(Request $request)
    {

        $item = Item::find($request->input('del-item-id'));

        $item->is_active = 0;
        $item->save();

        return redirect('maintenance/item');
    }
    
}

