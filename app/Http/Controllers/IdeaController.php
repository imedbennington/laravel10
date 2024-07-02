<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Idea;
class IdeaController extends Controller
{

/*    public function show($id)
    {
        $idea = Idea::find($id);
        dd($idea);
        return view('folder_show.show', ['idea' => $idea]);
    }
*/

public function show(Idea $idea)
{
    return view('folder_show.show', ['idea' => $idea]);
}

public function edit(Idea $idea)
{
    if(auth()->id() !== $idea->user_id){
        abort(404,"denied");
    }
    $editing = true;
    return view('folder_show.show', ['idea' => $idea, 'editing' => $editing]);
}


public function update(Request $request, Idea $idea)
{
    if(auth()->id() !== $idea->user_id){
        abort(404,"denied");
    }
    // Validate the request and store the validated data in a variable
    $validated = $request->validate([
        'content' => 'required|min:2|max:400'
    ]);

    // Update the idea using the validated data
    $idea->update($validated);

    // Redirect to the idea.show route with a success message
    return redirect()->route('idea.show', $idea)->with('success', 'Idea updated!');
}

public function destroy(Idea $idea)
{
    if(auth()->id() !== $idea->user_id){
        abort(404,"denied");
    }
    $idea->delete();
    return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
}


public function store (){
       // dump(request()->get('input_idea'));
       /*
        request()->validate([
            'input_idea'=>'required|min:2|max:400'
        ]);
       $idea = Idea::create([
            'content'=>request()->get('input_idea',''),
        ]);*/

         // Validate the request and store the validated data in a variable
         $validated = request()->validate([
            'input_idea' => 'required|min:2|max:400'
        ]);
        
        // Add the authenticated user's ID to the validated data
        $validated['user_id'] = auth()->id();
        
        // Create a new idea using the validated data
        $idea = Idea::create([
            'content' => $validated['input_idea'],
            'user_id' => $validated['user_id'],
        ]);
        
        // Redirect to the dashboard with a success message
        return redirect()->route('dashboard')->with('success', 'Idea created!');

    }
/*
    public function destroy(Idea $idea)
    {
        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }

    public function destroy(Idea $idea)
    {
        $idea->delete();
        return redirect()->route('dashboard')->with('success', 'Idea deleted successfully');
    }*/
}
