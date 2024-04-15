<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Type;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function list(){

        $brands = Brand::all();
        $list = [];
        
        foreach($brands as $brand) {

            $object = [
                "id" => $brand->id,
                "name" => $brand->name
                
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }
    public function item($id){
        $brand = Brand::where('id', '=', $id)->first();


            $object = [
                "id" => $brand->id,
                "name" => $brand->name
                
            
            ];
            
            return response()->json($object);
    }   
        public function create(Request $request){
            $data = $request->validate([
            'name' => 'required'
            ]);

            $brand = Brand::create([
                'name' => $data['name']
            ]);

            if($brand) {
                return response() -> json([
                    'message' => 'Guardado exitoso',
                    'data' => $brand
                ]);
            }else{
                return response() -> json([
                    'message' => 'Guardado no exitoso'
                ]);
            }
        }
        public function update(Request $request){
            $data = $request -> validate([
                'id' => 'required',
                'name' => 'required'
            ]);
            $brand = Brand::where('id', '=', $data['id']) ->first();
            
            if($brand){
                $old = $brand;
                $brand->id = $data['id'];
                $brand->name =$data['name'];
                if($brand->save()){
                    $object = [
                        "response" => 'Success. Item updated correctly.',
                        "old" => $old,
                        "new" => $brand,
                    ];
                    return response()->json($object);
                }else{
                    $object =[
                        "response" => 'Error: Somenthing went wrong, please try again.',
                    ];
                }
                
            }else{
                $object =[
                    "response" => 'Error: Element not found.',
                ];
                return response()->json($object);
            }
        }

        public function getTypesForBrand($brandId) {
            $brand = Brand::findOrFail($brandId); 
        
            $types = Type::where('brand_id', $brand->id)->get(); 
        
            $response = [
                'brand' => $brand,
                'types' => $types
            ];
        
            return response()->json($response);
        }
        public function delete($id) {
            $brand = Brand::find($id);
        
            if (!$brand) {
                return response()->json([
                    'message' => 'Error: Element not found.'
                ], 404);
            }
        
            if (
                !$brand->delete()) {
                return response()->json([
                    'message' => 'Brand deleted successfully'
                ]);
            } else {
                return response()->json([
                    'message' => 'Error: Something went wrong while deleting the post.'
                ], 500);
            }
        }
        
}

