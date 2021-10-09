<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileWeb extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $fillable = [
        'name', 'description', 'image', 'youtube', 'date', 'location'
    ];
}
