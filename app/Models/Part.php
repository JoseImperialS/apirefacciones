<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Type;

class Part extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'model_id'
        
    ];

    public function type(){
        return $this->belongsTo(Type::class, 'model_id');
    }
}
