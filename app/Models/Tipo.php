<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Tipo extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['titulo','icone'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->uuid = Uuid::uuid4();
        });
    }


}
