<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization_user extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id','organization_id'
    ];

    public function user()
    {
        return $this->hasMany('App\Models\User','user_id');
    }

    public function organization()
    {
        return $this->hasMany('App\Models\Organization','organization_id');
    }
}
