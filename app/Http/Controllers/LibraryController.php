<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Library;
use Illuminate\Support\Facades\File as File2;
use Illuminate\Support\Facades\Storage;

class LibraryController extends Controller
{
    /************************************/
    public function libraries(Request $request)
    {
        $product_type = $request->input('product_type');
        if(is_numeric($product_type)){
            $files = Library::select('filenames')->where('product_type','=',$product_type)
                ->get()
                ->toArray();
        }else{
            $files = Library::select('filenames')
                ->get()
                -> toArray();
        }

        return response()->json($files, 200);
    }
    /************************************/
    public function libraries_get_from_disk(Request $request)
    {
        $product_type = $request->input('product_type');
        $files_temp =  Storage::disk('local')->files('images');
        $files = array_map(function($file){
            return basename($file); // remove the folder name
        }, $files_temp);
        //print_r($files);die();
        //$files = Library::all()->toArray();
        //print_r($files);die();
        return response()->json(['files' => $files], 200);
    }
    /***********************************/
    public function add_image_library(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required',
            'file.*' => 'required'
        ]);
        $product_type = $request->input('product_type');

        $files = [];
        if($request->hasfile('file')  )
        {
            foreach($request->file('file') as $file)
            {
                $name = rand(1,100).'.'.$file->getClientOriginalName();
                $file->storeAs('images', $name);
                $filenames = array('filenames'=>$name,'product_type'=>$product_type) ;
                $files[]=$filenames;
            }
        }
        //print_r($filenames); die();

        Library::insert($files);

        return response()->json(['files' => $files], 200);
    }
}
