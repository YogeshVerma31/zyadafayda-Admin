<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentCompany extends Model
{
    use HasFactory;


    protected $fillable = [
        'logo',
        'title',
        'sub_title',
        'link',
    ];
}
