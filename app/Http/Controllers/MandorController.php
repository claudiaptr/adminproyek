<?php

namespace App\Http\Controllers;

use App\Models\Mandor;
use Illuminate\Http\Request;

class MandorController extends Controller
{
    // Display a listing of the mandor.
    public function index()
    {
        $mandor = Mandor::all(); // Retrieve all mandor
        return view('mandor.index', compact('mandor')); // Pass data to the view
    }

    // Show the form for creating a new mandor.
    public function create()
    {
        return view('mandor.create'); // Return create form view
    }

    // Store a newly created mandor in storage.
    public function store(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Create a new Mandor
        Mandor::create($validated);

        // Redirect to the list of mandor with a success message
        return redirect()->route('mandor.index')->with('success', 'Mandor created successfully!');
    }

    // Show the form for editing the specified mandor.
    public function edit($id)
    {
        $mandor = Mandor::findOrFail($id); // Find the mandor by ID
        return view('mandor.edit', compact('mandor')); // Return edit form view with mandor data
    }

    // Update the specified mandor in storage.
    public function update(Request $request, $id)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Find the mandor and update the data
        $mandor = Mandor::findOrFail($id);
        $mandor->update($validated);

        // Redirect with a success message
        return redirect()->route('mandor.index')->with('success', 'Mandor updated successfully!');
    }

    // Remove the specified mandor from storage.
    public function destroy($id)
    {
        // Find the mandor and delete it
        $mandor = Mandor::findOrFail($id);
        $mandor->delete();

        // Redirect with a success message
        return redirect()->route('mandor.index')->with('success', 'Mandor deleted successfully!');
    }
}
