<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demndcongs extends Model
{
    use HasFactory;
    protected $fillable = [
        'dateD','dateF','etat','cause','id_employe'
    ];
    public function employes()
    { 
        return $this->belongsTo(Employes::class,"id_employe"); 
    }
}
