<?php

namespace App\Http\Controllers\Api;

use App\Models\TaskList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ListController extends Controller
{
    public function index()
    {
        $lists = TaskList::with('tasks')->get();
        return response()->json($lists);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id'
        ]);

        $taskList = TaskList::create($validatedData);
        return response()->json($taskList, 201);
    }

    public function update(Request $request, $listId)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $taskList = TaskList::findOrFail($listId);

        $taskList->update($validatedData);

        return response()->json($taskList, 200);
    }

    public function destroy(TaskList $list)
    {
        $list->delete();
        return response()->json(null, 204);
    }
}
