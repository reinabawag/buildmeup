<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\User;
use Session;
use Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::where('user_id', Auth::id())->get();

        return  view('item.index')->withItems($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::all();

        return view('item.create')->with(['items' => $items, 'prodCodes' => Item::GetProdCodes()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, array(
            'item'          => 'required',
            'description'   => 'required',
            'type'          => 'required',
            'source'        => 'required',
            'cost_type'     => 'required',
            'cost_method'   => 'required',
            'abc_code'      => 'required',
            'unit_measure'  => 'required',
            'unit_weight'   => 'required',
        ));

        $user = User::find(Auth::id());
        $item = $user->items()->create($request->all());

        Session::flash('success', 'Item buildup created'); 

        return redirect()->route('item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('item.show')->withItem($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $product_codes = [];
        foreach (Item::GetProdCodes() as $key => $product_code) {
            array_push($product_codes, [$product_code->product_code => "$product_code->product_code - $product_code->description"]);
        }
        
        return view('item.edit')->with(['item' => $item, 'prodCodes' => $product_codes]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $item->update($request->all());
        $item->save();

        return redirect()->back()->withSuccess('Item updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        if ($item->delete())
        return redirect()->route('item.index')->withSuccess("$item->item - $item->description was successfully deleted");
    }
}
