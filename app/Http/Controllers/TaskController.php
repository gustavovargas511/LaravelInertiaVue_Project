<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return inertia('Dashboard', [
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return inertia('Tasks/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data['user_id'] = auth()->id();

        Task::create($data);

        return redirect()->route('dashboard');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // dd($task);
        
        return inertia('Tasks/Edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        $task->update($data);

        return redirect()->route('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $task = Task::where('id', $id)->where('user_id', auth()->id())->firstOrFail();

        // dd($task);
        $task->delete();

        return redirect()->route('dashboard');
    }
}
