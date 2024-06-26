<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameters extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom','logo','email','tel','rib','mf','adresse','fax'
    ]; 
}
