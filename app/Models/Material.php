<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public $table = 'materials';

    protected $fillable = [
        'name',
        'count',
        'img'
    ];
}
