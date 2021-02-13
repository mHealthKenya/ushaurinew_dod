<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unrecognised extends Model
{
    use HasFactory;

    public $table = 'tbl_unrecognised';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        
    ];
}
