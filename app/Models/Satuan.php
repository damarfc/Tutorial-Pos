<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
    use HasFactory;

    protected $primaryKey = 'FK_SAT';
    public $incrementing = false;

    protected $fillable =[
        'FK_SAT',
        'FN_SAT',
    ];
}
