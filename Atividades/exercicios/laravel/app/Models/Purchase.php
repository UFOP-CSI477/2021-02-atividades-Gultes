<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'person_id',
        'product_id',
    ];

    public function person()
    {
        return $this->belongsTo(Person::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
