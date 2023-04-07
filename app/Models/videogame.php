<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class videogame extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['title', 'description', 'cover', 'price'];
}
