<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $table = 'family_members';
    protected $fillable = ['user_id','name', 'age', 'relationship'];

    public function user() {
        return $this->belongsTo(App\Models\Registration::class);
    }
}
