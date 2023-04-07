<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class purchase extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['buyername', 'email', 'id_videogame'];
}
