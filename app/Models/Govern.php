<?php

namespace App\Models;

use App\Enums\StatusType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Govern extends Model
{
    use HasFactory;

    protected $fillable = ['name']; 

   public function infected($status,$id)
   {
        $count = User::where('status',StatusType::getValue($status))->where('govern',$id)->count();
        return $count;
   }
}
