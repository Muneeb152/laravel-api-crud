<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable =[
       'name',
       'items',
       'discount',
       'description',

    ];
    
    public function discounts()
    {
        return $this->belongsToMany(Discount::class)->withPivot('value');
    }

}
