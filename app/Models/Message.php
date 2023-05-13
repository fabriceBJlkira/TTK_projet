<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_id',
        'to_id',
        'contenue',
        'read_at'
    ];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
