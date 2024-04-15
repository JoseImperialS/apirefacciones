<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand; 

class Type extends Model

{
    use HasFactory;
    protected $table = 'models';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'brand_id',
        'first_year',
        'last_year'
    ];

    public function brand(){
        return $this->belongsTo(Brand::class);
    }
}
