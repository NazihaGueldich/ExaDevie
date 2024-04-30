<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emplinpays extends Model
{
    use HasFactory;
    protected $fillable = [
        'etat','montant','id_employe'
    ];
    public function employes()
    { 
        return $this->belongsTo(Employes::class,"id_employe"); 
    }
}
