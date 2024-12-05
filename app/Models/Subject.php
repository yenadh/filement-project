<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $primaryKey = 'subject_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // public function modules()
    // {
    //     return $this->belongsToMany(
    //         Module::class,
    //         'subject_modules',
    //         'subject_id',
    //         'module_id'
    //     );
    // }

    public function subjectModules()
    {
        return $this->hasMany(subject::class, 'subject_id', 'subject_id');
    }
}
