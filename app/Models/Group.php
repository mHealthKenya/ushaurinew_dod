<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public $table = 'tbl_groups';
    public $timestamps = false;
    public $incrementing = false;
    
    protected $fillable = [
        
    ];
}
