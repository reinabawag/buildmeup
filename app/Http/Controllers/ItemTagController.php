<?php

namespace App\Http\Controllers;

use App\Tag;
use App\ItemTag;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ItemTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'code' => [
                'required',
                Rule::unique('item_tags')->where(function($query) use($request) {
                    $query->where('tag_id', $request->tag_id);
                })
            ],
            'type' => 'required',
        ], ['code.unique' => 'Same tag and code combination exist!',]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        $itemTag = new ItemTag;
        $tag = Tag::find($request->tag_id);
        $itemTag->tag()->associate($tag);
        $itemTag->code = $request->code;
        $itemTag->type = $request->type;
        $itemTag->save();

        return redirect()->back()->withStatus('Item tag created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function show($itemTag)
    {
        foreach(Tag::select('id', 'name')->get() as $tag) {
            $tags[$tag->id] = $tag->name;
        }

        return view('item-tag.show')->with(['itemTag' => ItemTag::findOrFail($itemTag), 'tags' => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemTag $itemTag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $itemTag)
    {
        $itemTag = ItemTag::find($itemTag);

        if (! ($itemTag->tag_id == $request->tag_id)) {
            $rules = ['code' => ['required', Rule::unique('item_tags')->where(function($query) use($request) { $query->where('tag_id', $request->tag_id); }) ],
                'type' => 'required',
            ];
        } else {
            $rules = ['code' => 'required', 'type' => 'required'];
        }        

        $validator = Validator::make($request->all(), $rules, ['code.unique' => 'Same tag and code combination exist!']);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $itemTag->tag()->associate(Tag::find($request->tag_id));
        $itemTag->code = $request->code;
        $itemTag->type = $request->type;
        $itemTag->save();

        return redirect()->route('tag.show', $itemTag->tag_id)->withStatus("$itemTag->type updated!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ItemTag  $itemTag
     * @return \Illuminate\Http\Response
     */
    public function destroy($itemTag)
    {
        $itemTag = ItemTag::find($itemTag);
        $itemTag->delete();

        return redirect()->route('tag.show', $itemTag->tag_id)->withStatus("$itemTag->code - $itemTag->type removed!");
    }
}
