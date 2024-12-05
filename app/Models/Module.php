<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    protected $primaryKey = 'module_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // public function subjects()
    // {
    //     return $this->belongsToMany(
    //         Subject::class,
    //         'subject_modules',
    //         'module_id',
    //         'subject_id'
    //     );
    // }

    public function subjectModules()
    {
        return $this->hasMany(SubjectModule::class, 'module_id', 'name');
    }
}
