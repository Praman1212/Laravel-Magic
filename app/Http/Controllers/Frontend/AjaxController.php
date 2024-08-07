<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Ajax;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Ajax::latest()->get();
        return view('ajax.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ajax.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'name',
            'phone',
            'email'
        ]);
        
        // partial view concept
        Ajax::create($data);
        $items = Ajax::all();
        $partialView = view('ajax.table', ['items' => $items])->render();
        return response()->json([
            'data' => $partialView,
            'url' => route('ajax.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Ajax::find($id);
        $partialView = view('ajax.show',['item' => $item])->render();
        return response()->json([
            'data' => $partialView,
            'url' => route('ajax.show',$item->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Ajax::findOrFail($id);
        $partialView = view('ajax.create',['item' => $item])->render();
        return response()->json([
            'data' => $partialView,
            'url' => route('ajax.edit',$item->id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name', 'email', 'phone']);
        $item = Ajax::findOrFail($id);
        $item->update($data);
        $items = Ajax::all();
        $partialView = view('ajax.table', ['items' => $items])->render();
        return response()->json([
            'data' => $partialView,
            'url' => route('ajax.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Ajax::findOrFail($id);
        $item->delete();
        return redirect()->back();
    }
}
