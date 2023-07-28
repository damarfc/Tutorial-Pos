<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $primaryKey = 'FK_SUP';
    public $incrementing = false;

    protected $fillable = [
        'FK_SUP',
        'FNA_SUP',
        'FNOTELP',
        'FALAMAT',
        'FCONTACT'
    ];
}
