<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function petOwner() {
        return $this->belongsTo(PetOwner::class, 'pet_owner_id', 'pet_owner_id');
    }

    public function vet() {
        return $this->belongsTo(Vet::class, 'vet_id', 'vet_id');
    }
}
