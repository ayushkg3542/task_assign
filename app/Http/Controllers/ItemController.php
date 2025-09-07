<?php

namespace App\Http\Controllers;

use App\Models\Notes;
use Illuminate\Http\Request;
use Validator;

class ItemController extends Controller
{
    public function create()
    {
        return view('item.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]);

        $exists = Notes::where('title', $request->title)->exists();

        if ($exists && $validator->passes()) {
            return response()->json(['status' => 'fail', 'message' => 'Duplicate entry exists']);
        } else {
            $notes = new Notes();
            $notes->title = $request->title;
            $notes->description = $request->description;
            $notes->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Notes added successfully'
            ]);
        }
    }

    public function edit($id)
    {
        $notes = Notes::find($id);

        if (!$notes) {
            return response()->json(['success' => false, 'message' => 'Not found']);
        }

        return view('item.edit', compact('notes'));
    }

    public function modify($id, Request $request)
    {
        $notes = Notes::find($id);
        if (empty($notes)) {
            return response()->json([
                'status' => true,
                'message' => 'Note not found'
            ]);
        }

        $notes->title = $request->title;
        $notes->description = $request->description;
        $notes->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Note updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $note = Notes::findOrFail($id);
        $note->delete();
        return redirect()->route('dashboard')->with('success', 'Note deleted successfully!');
    }
}