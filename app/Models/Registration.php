<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $table = 'registrations';
    protected $fillable = ['name', 'age', 'email', 'passport', 'dob'];

    public function family_members() {
        return $this->hasMany(Family::class, 'user_id');
    }
}
