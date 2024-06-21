<?php

namespace App\Models;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Skill extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
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

    public function vacancies(){
        return $this->belongsToMany(Vacancy::class, 'vacancy_skill', 'vacancy_id', 'skill_id');
    }
}
