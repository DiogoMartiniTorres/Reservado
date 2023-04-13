<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Ramsey\Uuid\Uuid;

class Equipamentos extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['tipo_id','nome','data_aquisicao'];

    protected $table = 'equipamentos';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->uuid = Uuid::uuid4();
        });
    }

    public function tipo(){
        return $this->belongsTo(Tipo::class,'tipo_id');
    }


}