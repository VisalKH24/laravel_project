<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table= 'products';
    protected $fillable = [
        'product_name',
        'qty',
        'reqular_price',
        'sale_price',
        'cate_id',
        'size',
        'color',
        'description',
        'image',
        'user_id'
    ];
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
