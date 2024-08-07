<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Email::all();
        return view('email.index',compact('items'));
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
        $data = $request->only([
            'your_email',
            'client_email',
            'message'
        ]);
        $email = Email::create($data);

        Mail::raw($email->message, function ($message) use ($email) {
            $message->from($email->your_email)
                ->to($email->client_email)
                ->subject('New Message');
        });
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
        $item = Email::find($id);
        return view('email.create',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->only([
            'your_email',
            'client_email',
            'message'
        ]);
        $email = Email::find($id);
        $email->update($data);

        Mail::raw($email->message, function ($message) use ($email) {
            $message->from($email->your_email)
                ->to($email->client_email)
                ->subject('New Message');
        });

        return redirect()->route('email.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Email::find($id);
        $item->delete();
        return redirect()->back();
    }
}
