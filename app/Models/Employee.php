<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['first_name', 'last_name', 'phone','email','adress', 'birth_day'];


    public function presences()
    {
        return $this->hasMany(Presence::class,'presence_id','id');
    }

}
