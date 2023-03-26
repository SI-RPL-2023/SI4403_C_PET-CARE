<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PetOwner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    public function order() {
        return $this->hasMany(Order::class);
    }

    public function appointment() {
        return $this->hasOne(Appointment::class, 'pet_owner_id', 'pet_owner_id');
    }
}
