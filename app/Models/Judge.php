<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Judge extends Model
{
    use HasFactory;

    // public $timestamps = false;
    protected $table = 'judge';
    protected $primaryKey = 'jd_id';

    protected $fillable = [
        'jd_title', 'jd_first_name', 'jd_middle_name', 'jd_last_name', 'jd_name', 'jd_photo', 'jd_dob', 'jd_qual', 'dt_enroll', 'dt_ele', 'dt_appt',  'jd_display', 'jd_desg', 'jd_telephone_no', 'jd_fax_no', 'jd_mobile_no', 'jd_email_id',
    ];
}
