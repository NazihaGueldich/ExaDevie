<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lignesdevis extends Model
{
    use HasFactory;
    protected $fillable = [
        'type','designiation','id_produit','prix','prixT','tva','tht','ptttc','quantiter','id_devi'
    ];
    public function produits()
    { 
        return $this->belongsTo(Produits::class,"id_produit"); 
    }
    public function devis()
    { 
        return $this->belongsTo(Devis::class,"id_devi"); 
    }
}
