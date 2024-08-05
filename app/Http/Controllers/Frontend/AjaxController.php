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
        return view('ajax.index',compact('items'));
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
        Ajax::create($data);
        return response()->json([
            'route' => route('ajax.index'),
            'status' => 'Form submitted successfully'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Ajax::find($id);
        return view('ajax.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Ajax::findOrFail($id);
        return view('ajax.create',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only(['name','email','phone']);
        $item = Ajax::findOrFail($id);
        $item->update($data);
        return response()->json([
            'route' => route('ajax.index'),
            'status' => 'Form updated successfully'
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
