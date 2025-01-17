<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResources;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Todo::all();

        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => TodoResources::collection($data),
            'message' => 'Todo List data fetched successfully.'
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->only([
            'title',
            'image'
        ]);
        // php artisan storage:link
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hashedName = md5($image->getClientOriginalName() . time()) . '.' . $image->extension();
            $imagePath = $image->storeAs('uploads/todo', $hashedName, 'public');
            $data['image'] = $imagePath;
        }
        $item = Todo::create($data);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($item),
            'message' => "Data stored successfully"
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Todo::find($id);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($data),
            'message' => 'Data shown successfully.'
        ], Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $item = Todo::find($id);
        $data = $request->only([
            'title',
            'image'
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $hashedName = md5($image->getClientOriginalName() . time()) . '.' . $image->extension();
            $imagePath = $image->storeAs('uploads/todo', $hashedName, 'public');
            $data['image'] = $imagePath;
        }
        $item->update($data);
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($item),
            'message' => 'Data updated successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Todo::find($id);
        $data->delete();
        return response()->json([
            'status' => 200,
            'success' => true,
            'data' => new TodoResources($data),
            'message' => "Data deleted successfully"
        ], Response::HTTP_OK);
    }
}
