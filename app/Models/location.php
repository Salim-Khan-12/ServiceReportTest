<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID_location'; 
    protected $fillable = [
        'name_location',
        'ID_project',
    ];
}
