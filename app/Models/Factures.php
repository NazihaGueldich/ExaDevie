<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factures extends Model
{
    use HasFactory;
    protected $fillable = [
        'num','sujet','MTTTC','MTHT','totTVA','id_devi','id_client'
    ];
    public function devis()
    { 
        return $this->belongsTo(Devis::class,"id_devi"); 
    }
    public function clients()
    { 
        return $this->belongsTo(Clients::class,"id_client"); 
    }
}
