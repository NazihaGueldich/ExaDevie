<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payementfacts extends Model
{
    use HasFactory;
    protected $fillable = [
        'type','virement','date','id_facture'
    ];
    public function factures()
    { 
        return $this->belongsTo(Factures::class,"id_facture"); 
    }
}