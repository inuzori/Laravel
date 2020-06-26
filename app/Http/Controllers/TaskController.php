<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {   
        $request->session()->put("user_id",45);
        $tasks = Task::paginate();
      //  dd($tasks);
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        Task::create($inputs);

        return redirect()->route('tasks.index')->with('message', 'Task created successfully.');
    }

    public function show(Task $task,Request $request)
    {
        $request->session()->flush();
        return view('tasks.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $inputs = $request->all();
        // dd($inputs);
        if (!isset($inputs['completed'])) $inputs['completed'] = false;
        $task->update($inputs);

        return redirect()->route('tasks.index')->with('message', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('message', 'Task deleted successfully.');
    }
}