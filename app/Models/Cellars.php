<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cellars extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'users_id'];

    //un cellier appartient à un utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
