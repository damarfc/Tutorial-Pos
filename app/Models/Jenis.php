<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $primaryKey = 'FK_JENIS';
    public $incrementing = false;

    protected $fillable = [
        'FK_JENIS',
        'FN_JENIS',
    ];
}
