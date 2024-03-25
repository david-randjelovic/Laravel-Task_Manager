<?php

namespace App\Models;

use App\Models\TaskList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'list_id'];

    public function taskList()
    {
        return $this->belongsTo(TaskList::class, 'list_id');
    }
}
