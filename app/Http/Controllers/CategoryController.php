<?php

namespace App\Http\Controllers;
use App\Models\Models\Category;
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

    public function delete_image(Request $request)
    {
       $fileName = $request->imageName;
       $this->deleteFileFromServer($fileName);
       return 'Done';
    }

    public function deleteFileFromServer($fileName)
    {
       $filePath = public_path().'/uploads/'.$fileName;
       if(file_exists($filePath)){
           unlink($filePath);
       }
       return ;
    }

    public function create_category(Request $request)
    {
        $request->validate([
            'categoryName' => 'required',
            'iconImage' => 'required'
        ]);

       return Category::create([
            'categoryName' => $request->categoryName,
            'iconImage' => $request->iconImage
        ]);
    }

    public function get_categories()
    {
        return Category::orderBy('id','desc')->get();
    }
}
