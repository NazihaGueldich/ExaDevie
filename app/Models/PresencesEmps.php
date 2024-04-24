<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresencesEmps extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','etat','cause','id_employe'
    ];
    public function employes()
    { 
        return $this->belongsTo(Employes::class,"id_employe"); 
    }
}
