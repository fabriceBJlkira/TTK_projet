<?php

namespace App\Models;

use App\Models\Team;
use App\Models\User;
use App\Models\UserGame;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Games extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'banner',
        'icone',
        'specifique'
    ];

}
