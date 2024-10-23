<?php

namespace App\Http\Controllers;

use App\Models\Notebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NotebookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user_id = Auth::id();
        $notebooks = Notebook::where('user_id', $user_id)->latest()->get();
        return view('notebooks.index', compact('notebooks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('notebooks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $attributes = $request->only(['name']);
        $attributes['user_id'] = Auth::id();
        $attributes['uuid'] = Str::uuid();
        Notebook::create($attributes);

        return redirect(route('notebooks.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Notebook $notebook)
    {
        if(!$notebook->user_id == Auth::id()){
            abort('403');
        }
        return view('notebooks.show', compact('notebook'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notebook $notebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notebook $notebook)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notebook $notebook)
    {
        //
    }
}
