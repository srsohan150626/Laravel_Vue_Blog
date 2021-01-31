<?php

namespace App\Http\Controllers;
use App\Models\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function add_tag(Request $request)
    {
        $request->validate([
            'tagName' => 'required'
        ]);

       return Tag::create([
            'tagName' => $request->tagName
        ]);
    }

    public function get_tags()
    {
        return Tag::orderBy('id','desc')->get();
    }

    public function edit_tag(Request $request)
    {
        $request->validate([
            'tagName' => 'required',
            'id'      => 'required'
        ]);

       return Tag::where('id',$request->id)
                ->update([
                    'tagName' => $request->tagName
                ]);
    }

    public function delete_tag(Request $request)
    {
        $request->validate([
            'id'      => 'required'
        ]);
       return Tag::where('id',$request->id)->delete();
    }
}
