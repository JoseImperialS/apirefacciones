<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Type;

class BrandTypeController extends Controller
{
    public function index($brandId)
    {
        // Aquí colocarías la lógica para manejar la solicitud
        // por ejemplo, recuperar los tipos asociados a la marca con ID $brandId
        $brand = Brand::findOrFail($brandId);
        $types = $brand->types()->get();
        
        return response()->json($types);
    }
}

