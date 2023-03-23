<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $table = 'district';
    protected $primaryKey = 'dist_code';
    protected $fillable = [
        'dist_name', 'dist_headquarter', 'dist_img', 'display'
    ];

    public function sub_divisions()
    {
        return $this->hasMany(SubDivision::class, 'dist_code', 'dist_code');
    }
}
