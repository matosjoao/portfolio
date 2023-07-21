<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['project_image'];

    public function project_image()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
