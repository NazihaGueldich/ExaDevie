<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;
    protected $fillable = [
        'sujet','MTTTC','MTHT','TotTva','etat','id_client'
    ];
    public function clients()
    { 
        return $this->belongsTo(Clients::class,"id_client"); 
    }
}
