<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function list() {

        $types = Type::all();
        $list = [];

        foreach($types as $type) {

            $object = [
                "id" => $type->id,
                "name" => $type->name,
                "first_year" => $type ->first_year,
                "last_year" => $type->last_year,
                "brand" => $type->brand
            
            ];

            array_push($list, $object);
        }

        return response()->json($list);
    }

    

    public function typesForBrand($brandId) {
        $types = Type::where('brand_id', $brandId)->get();
    
        $list = [];
        foreach ($types as $type) {
            $object = [
                "id" => $type->id,
                "name" => $type->name,
                "first_year" => $type->first_year,
                "last_year" => $type->last_year,
                "brand_id" => $type->brand_id // Cambia 'brand' por 'brand_id' si solo necesitas el ID de la marca
            ];
            array_push($list, $object);
        }
    
        return response()->json($list);
    }
    
    public function item($id){
        $type = Type::where('id', '=', $id)->first();

        $object = [
            "id" => $type->id,
            "name" => $type->name,
            "brand_id" => $type->brand_id,
            "fist_year" => $type->first_year,
            "last_year" => $type->last_year
        
        ];
        return response()->json($object);
    }
    

    public function create(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'brand_id' => 'required',
            'first_year' => 'required',
            'last_year' => 'required',
        ]);

        $type = Type::create([
            'name' => $data['name'],
            'brand_id' => $data['brand_id'],
            'first_year' => $data['first_year'],
            'last_year' => $data['last_year']
        ]);

        if($type) {
            return response()->json([
                'message' => 'Guardado exitoso',
                'data' => $type
            ]);
        } else {
            return response()->json([
                'message' => 'Guardado no exitoso'
            ]);
        }
    }
    public function update(Request $request){
        $data = $request -> validate([
            'name' => ['name'],
            'brand_id' => ['brand_id'],
            'first_year' => ['first_year'],
            'last_year' => ['last_year']
        ]);
        $type = Type::where('id', '=', $data['id']) ->first();
        
        if($type){
            $old = $type;
            $type->id = $data['id'];
            $type->name =$data['name'];
            $type->brand_id =$data['brand_id'];
            $type->first_year =$data['first_year'];
            $type->last_year =$data['last_year'];
            if($type->save()){
                $object = [
                    "response" => 'Success. Item updated correctly.',
                    "old" => $old,
                    "new" => $type,
                ];
                return response()->json($object);
            }else{
                $object =[
                    "response" => 'Error: algo salio mal, intente de nuevo por favor.',
                ];
            }
            
        }else{
            $object =[
                "response" => 'Error: no se encontro el elemento.',
            ];
            return response()->json($object);
        }
    } 
    public function general($name){
        $types = Type::where('name', 'LIKE', '%'. $name .'%')->get();
        
        $list =[];

        foreach($types as $type) {
        $object= 
            [
                "id" => $type->id,
                "name" => $type->name,
                "brand_id" => $type->brand_id,
                "fist_year" => $type->first_year,
                "last_year" => $type->last_year
            
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }
    
    public function element($name){
        $types= Type::where('name', '=', $name)->get();
        $list=[];
        foreach($types as $type){
            $item= [
                "id" => $type->id,
                "name" => $type->name,
                "brand_id" => $type->brand_id,
                "fist_year" => $type->first_year,
                "last_year" => $type->last_year
            ];
            array_push($list, $item);
        }
        
        return response()->json($list);
    }
    
}