<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:jpeg,jpg,png'
        ]);
      $picName = time().'.'.$request->file->extension();
      $request->file->move(public_path('uploads'),$picName);
      return $picName;
    }
}
