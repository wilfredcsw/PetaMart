<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    protected $fillable = ['ProductName', 'ProductPrice', 'ProductQuantity', 'TotalPrice'];
    
}
