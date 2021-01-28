<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;
    protected $primaryKey = 'ID_project'; 
    protected $fillable = [
        'code_project',
        'name_project',
        'name_office',
    ];
}
