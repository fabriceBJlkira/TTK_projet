<?php

namespace App\Models;

use App\Models\User;
use App\Models\TeamUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'user_id',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
        ->using(TeamUser::class)
        ->withPivot('statut')
        ->withTimestamps();
    }
}
