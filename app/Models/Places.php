<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Places extends Model
{
    use HasFactory;

    protected $table = 'places';
    protected $fillable = [
        'name',
        'descripcion',
        'addres',
        'id_categories'
    ];

    public $timestamps = false;
}
