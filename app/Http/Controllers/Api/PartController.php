<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Part;
use Illuminate\Http\Request;

class PartController extends Controller
{
    public function list()
{
    $parts = Part::all()->toArray(); // Convertir la colección de partes a un array

    return response()->json($parts); // Devolver el array como JSON
}


public function partsFortypes($typeId) {
    $types = Part::where('model_id', $typeId)->get();

    $list = [];
    foreach ($types as $type) {
        $object = [
            "id" => $type->id,
            "name" => $type->name,
            "first_year" => $type->first_year,
            "last_year" => $type->last_year,
            "model_id" => $type->model_id // Cambia 'brand' por 'brand_id' si solo necesitas el ID de la marca
        ];
        array_push($list, $object);
    }
    return response()->json($list);
}

    public function item($id){
        $parts = Part::where('id', '=', $id)->first();

            $object = [
                "id" => $parts->id,
                "name" => $parts->name,
                "code" => $parts->code,
                "model_id" => $parts->model_id,
                "available" => $parts->available,
                "price" => $parts->price 
                
            ];
            return response()->json($object);
    }
    public function create(Request $request){
        $data = $request->validate([
            'name' => 'required',
            'code' => 'required',
            'model_id' => 'required',
            "available" => 'required',
            "price" => 'required' 
        ]);
        $part = Part::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'model_id' => $data['model_id'],
            'available' => $data['available'],
            'price' => $data['price']
        ]);
        if($part){
            return response() ->json([
            'message' => 'Guardado exitoso',
            'data' => $part
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
            'name' => 'required',
            'model_id' => 'required',
            "available" => 'required',
            "price" => 'required' 
        ]);
        $part = Part::where('id', '=', $data['id']) ->first();
        
        if($part){
            $old = $part;
            $part->id = $data['id'];
            $part->name =$data['name'];
            $part->model_id =$data['model_id'];
            $part->model_id =$data['available'];
            $part->model_id =$data['price'];
            if($part->save()){
                $object = [
                    "response" => 'Success. Item updated correctly.',
                    "old" => $old,
                    "new" => $part,
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
    public function general($name){
        $parts = Part::where('name', 'LIKE', '%'. $name .'%')->get();
        
        $list =[];

        foreach($parts as $part) {
        $object= 
            [
                "name" => $part->name,
                "code" => $part->code,
                "model_id" => $part->model_id,
                "available" => $part->available,
                "price" => $part->price
                
            ];
            array_push($list, $object);
        }
        return response()->json($list);
    }
    public function element($name){
        $parts= Part::where('name', '=', $name)->get();
        $list=[];
        foreach($parts as $part){
            $item= [
                "name" => $part->name,
                "code" => $part->code,
                "model_id" => $part->model_id,
                "available" => $part->available,
                "price" => $part->price
                
            ];
            array_push($list, $item);
        }
        
        return response()->json($list);
    }
    public function getPartsForModel($model)
    {
        // Lógica para obtener las partes del modelo específico
        $parts = Part::where('model_id', $model)->get();

        return response()->json($parts);
    }
}


