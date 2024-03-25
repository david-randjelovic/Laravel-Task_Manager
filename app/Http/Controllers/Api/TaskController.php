<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::all();
        return response()->json($tasks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'list_id' => 'required|exists:lists,id',
        ]);

        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->list_id = $request->list_id;
        $task->save();

        return response()->json($task, 201);
    }

    public function updateList(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'list_id' => 'required|exists:lists,id',
        ]);

        $task->list_id = $validatedData['list_id'];
        $task->save();

        return response()->json(['message' => 'Task updated successfully.', 'task' => $task]);
    }

    public function update(Request $request, $taskId)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::findOrFail($taskId);
        $task->update($validatedData);

        return response()->json($task, 200);
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return response()->json(['message' => 'Task deleted successfully.'], 200);
    }
}
