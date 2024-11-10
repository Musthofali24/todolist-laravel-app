<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $data = [
            "tasks" => Todo::orderBy('task', 'asc')->get(),
            "title" => "Todo List App",
            "name" => "Ali"
        ];

        return view('todo.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'task' => 'required|min:3|max:30'
        ], [
            'task.required' => 'Isian task wajib diisi',
            'task.min' => 'Minimal isian untuk task 3 karakter',
            'task.max' => 'Maksimal isian untuk task 30 karakter',
        ]);

        $data = [
            'task' => $request->input('task'),
        ];

        Todo::create($data);

        return redirect()->route('todo')->with('success', 'Berhasil Simpan Data');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'task' => 'required|min:3|max:30'
        ], [
            'task.required' => 'Isian task wajib diisi',
            'task.min' => 'Minimal isian untuk task 3 karakter',
            'task.max' => 'Maksimal isian untuk task 30 karakter',
        ]);

        $data = [
            'task' => $request->input('task'),
            'is_done' => $request->input('is_done')
        ];

        Todo::where('id', $id)->update($data);

        return redirect()->route('todo')->with('success', 'Berhasil Perbarui Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Todo::where('id', $id)->delete();

        return redirect()->route('todo')->with('success', 'Berhasil Hapus Data');
    }
}
