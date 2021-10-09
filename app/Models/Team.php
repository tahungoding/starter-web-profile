<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname', 'photo', 'position', 'division_id', 'sub_division_id'
    ];

    public function divisions()
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function sub_divisions()
    {
        return $this->belongsTo(SubDivision::class, 'sub_division_id');
    }
}
