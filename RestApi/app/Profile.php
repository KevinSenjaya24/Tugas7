<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = "profile";
    protected $fillable = [
        'id', 
        'nrp', 
        'nama',
        'foto',
        'prodi',
        'fakultas',
        'universitas',
    ];
}
