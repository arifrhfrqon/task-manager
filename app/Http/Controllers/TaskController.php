<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller {

    public function index()
    {
        $user = Auth::user();

        if ($user->role->name === 'admin') {
            $tasks = Task::all();
        } elseif ($user->role->name === 'manager') {
            $tasks = Task::where('created_by', $user->id)->get();
        } else { 
            $tasks = Task::where('assigned_to', $user->id)->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create() {
        $users = User::all();
        return view('tasks.create', compact('users'));
    }

    public function store(Request $r) {
        $r->validate(['title'=>'required']);
        Task::create([
            'title'=>$r->title,
            'description'=>$r->description,
            'created_by' => Auth::id(),
            'assigned_to'=>$r->assigned_to ?: null,
            'due_date'=>$r->due_date ?: null,
        ]);
        return redirect()->route('tasks.index')->with('success','Task dibuat.');
    }

    public function edit(Task $task) {
        $users = User::all();
        return view('tasks.edit', compact('task','users'));
    }

    public function update(Request $r, Task $task) {
        $task->update($r->only(['title','description','assigned_to','status','due_date']));
        return redirect()->route('tasks.index')->with('success','Task diperbarui.');
    }

    public function destroy(Task $task) {
        $task->delete();
        return back()->with('success','Task dihapus.');
    }

    public function staffTasks()
    {
        $tasks = Task::where('assigned_to', Auth::id())->get();
        return view('tasks.staff', compact('tasks'));
    }


    public function updateStatus(Request $request, Task $task)
    {
        $request->validate([
            'status' => 'required|in:pending,in_progress,completed,rejected'
        ]);

        $task->status = $request->status;
        $task->save();

        return redirect()->route('manager.tasks.index')->with('success', 'Status task berhasil diperbarui.');
    }


}
