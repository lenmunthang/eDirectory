<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDivision extends Model
{
    use HasFactory;
    protected $table = 'sub_division';
    protected $primaryKey = 'sub_div_code';
    protected $fillable = [
        'dist_code', 'sub_div_name', 'display'
    ];

    public function district()
    {
        return $this->belongsTo(District::class, 'dist_code', 'dist_code');
    }
}
