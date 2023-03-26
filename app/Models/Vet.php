<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function article() {
        return $this->hasMany(Article::class, 'vet_id', 'vet_id');
    }

    public function appointment() {
        return $this->hasMany(Appointment::class, 'vet_id', 'vet_id');
    }
}
