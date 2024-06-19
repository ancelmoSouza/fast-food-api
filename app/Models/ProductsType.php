<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsType extends Model
{
    use HasFactory;

    protected $table = 'products_type';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string, string>
     */
    protected $fillable = [
        'id',
        'type',
        'length',
    ];
}
