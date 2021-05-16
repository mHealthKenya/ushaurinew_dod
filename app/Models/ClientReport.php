<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientReport extends Model
{
    use HasFactory;

    public $table = 'client_report';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [

    ];
}
