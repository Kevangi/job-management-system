<?php

namespace App\Models;

use App\Models\Company;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Vacancy extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'opening',
        'last_apply_date',
        'job_type',
        'work_location',
        'salary',
        'company_id',
        'created_by',
        'updated_by'
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($module) {
            $user = auth()->user();
            if ($user) {
                $module->created_by = $user->id;
            }
        });

        static::updating(function ($module) {
            $user = auth()->user();
            if ($user) {
                $module->updated_by = $user->id;
            }
        });
    }

    public function companies(){
        return $this->belongsTo(Company::class);
    }

    public function skills(){
        return $this->belongsToMany(Skill::class, 'vacancy_skill', 'vacancy_id', 'skill_id');
    }
}
