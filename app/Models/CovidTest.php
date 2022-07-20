<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CovidTest extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'pcr_count',
        'antigen_count'
    ];
}
