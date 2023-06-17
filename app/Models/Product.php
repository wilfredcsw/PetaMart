<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $primaryKey = 'ProductID';
    protected $fillable = ['InventoryDate', 'ProductName', 'ProductDesc', 'ProductPrice', 'ProductQuantity', 'TotalPrice'];
    use HasFactory;
}
