<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligniefactures extends Model
{
    use HasFactory;
    protected $fillable = [
        'type','designiation','id_produit','prix','prixT','tva','tht','ptttc','quantiter','id_facture'
    ];
    public function produits()
    { 
        return $this->belongsTo(Produits::class,"id_produit"); 
    }
    public function factures()
    { 
        return $this->belongsTo(Factures::class,"id_facture"); 
    }
}
