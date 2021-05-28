<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Category;
use Validator;
class CategoryController extends Controller
{
    public function create(Request $request)
    {
          // Validate the inputs
          $validator = Validator::make($request->all(), [      
            'file' => 'file|mimes:jpg,gif,svg',
        ]); 
        $filename=""; 
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $file_extension = $file->getClientOriginalName();
                $destination_path = public_path() . '/category';
                $filename = $file_extension;
                
                $request->file('file')->move($destination_path, $filename);
                $input['file'] = $filename;

            }  
            $product = new Category([
                "category" => $request->get('category'),
                "image" => $filename,
            ]);
            $product->save(); // Finally, save the record.
        return redirect()->back();
    }
}
