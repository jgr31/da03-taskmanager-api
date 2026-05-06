<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json(Task::latest()->get());
    }

    public function show(Task $task)
    {
        return response()->json($task);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['nullable', 'in:pending,in_progress,done'],
        ]);

        $data['user_id'] = $request->user()->id;
        $data['status'] = $data['status'] ?? 'pending';

        return response()->json([
            'message' => 'Tasca creada correctament',
            'task' => Task::create($data),
        ], 201);
    }

    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title' => ['sometimes', 'string', 'max:255'],
            'description' => ['sometimes', 'nullable', 'string'],
            'status' => ['sometimes', 'in:pending,in_progress,done'],
        ]);

        $task->update($data);

        return response()->json([
            'message' => 'Tasca actualitzada correctament',
            'task' => $task,
        ]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['message' => 'Tasca eliminada correctament']);
    }
}
