<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    protected $fillable=['nomComplet', 'Email', 'telephone', 'Salaire'];
    use HasFactory;
}
