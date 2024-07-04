<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
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
        return view ('users.user-edit-card',compact('user','editing','ideas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(User $user)
{
    $validated = request()->validate([
        'name' => 'required|min:1|max:25',
        'bio' => 'required|min:1|max:255',
        'image' => 'image|nullable',
    ]);

    if (request()->hasFile('image')) {
        $path = request()->file('image')->store('profile_pictures', 'public');
        $validated['image'] = $path;
    }

    $user->update($validated);

    return redirect()->route('users.show', $user->id)->with('success', 'Profile updated successfully.');
}



    public function profile(){
        
        return $this->show(auth()->user());
    }
}
