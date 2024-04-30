<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Histcaisses extends Model
{
    use HasFactory;
    protected $fillable = [
        'type','description','prix','id_user'
    ];
    public function employes()
    { 
        return $this->belongsTo(Employes::class,"id_user"); 
    }
}
