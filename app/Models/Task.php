<?php
// File: app/Models/Task.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Project; 
use App\Models\User; 
use App\Models\Subtask; 

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'project_id',
        'status',
        'priority',
        'due_date',
    ];

    protected $casts = [
        'due_date' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }
}