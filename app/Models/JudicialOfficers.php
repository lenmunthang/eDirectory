<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudicialOfficers extends Model
{
    use HasFactory;
    protected $table = 'judicial_officers';
    protected $primaryKey = 'jo_id';

    protected $fillable = [
        'jo_code','jo_title', 'jo_first_name', 'jo_middle_name', 'jo_last_name', 'jo_name', 'jo_photo', 'jo_grade', 'jo_priority', 'jo_designation', 'jo_mslsa', 'jo_msja', 'jo_pop_district', 'jo_pop_sub_div', 'jo_dob', 'jo_qualification', 'jo_doa', 'jo_display', 'jo_telephone_no', 'jo_fax_no', 'jo_mobile_no', 'jo_email_id'
    ];
}
