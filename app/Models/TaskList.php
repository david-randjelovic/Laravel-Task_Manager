<?php

namespace App\Models;

use App\Models\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id'];

    protected $table = 'lists';

    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id');
    }
}
