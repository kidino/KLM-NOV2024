<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = User::all();
        // $users = User::where('email','thomas.turcotte@zmember.test')->get();

        $users = User::paginate(10);

        // return view('user.index', [
        //     'users' => $users,
        //     'cikgu' => 'Iszuddin'
        // ]);

        $cikgu = 'Iszuddin';

        return view('user.index', compact('users', 'cikgu'));
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
        //
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
    public function edit(User $user  /* $id */)
    {
        // $user = User::find($id);
        // dd($user);

        return view('user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request, $user);

        $rules = [
            'name' => 'required|string|max:255|min:5',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'user_type' => 'required|in:normal,admin'
        ];

        $validated_data = $request->validate( $rules );

        $user->name = $validated_data['name']; 
        $user->email = $validated_data['email'];
        $user->user_type = $validated_data['user_type'];

        $user->save();

        return redirect()->route('user.index')
            ->with('success','User has been updated');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
