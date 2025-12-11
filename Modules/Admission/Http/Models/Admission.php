<?php

namespace Modules\Admission\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\KamrulDashboard\Http\Models\User;

class Admission extends Model
{
    use HasFactory;
    protected $guarded = [];

    /**
     * The date fields for the model.clear
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'name',
        'slug',
        'photo',
        'father_name',
        'mother_nane',
        'phone',
        'dob',
        'religion',
        'gender',
        'nationality',
        'birth_registration',
        'pre_class',
        'class',
        'year',
        'pre_institution',
        'pre_gpa',
        'pre_address',
        'pre_postcode',
        'pre_country',
        'pre_states',
        'pre_city',
        'per_address',
        'per_postcode',
        'per_country',
        'per_states',
        'per_city',
        'loc_name',
        'loc_phone',
        'loc_relation',
        'loc_address',
        'loc_postcode',
        'status',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
