<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $ideas = $user->ideas()->orderBy('created_at')->paginate();
        return view ('users.show',compact('user','ideas'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $ideas = $user->ideas()->paginate();
        $editing = true;
        return view ('users.show',compact('user','editing','ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
    {
        //
    }
}
