<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\EventModel;

/**
 * FOR Admin only
 */

class EventFeatureController extends Controller
{
    public function eventIndex()
    {
        $data = [
            'events' => EventModel::all()->sortBy('created_at'),
        ];
        return view('event.index_event', $data);
    }

    public function eventStore(Request $request)
    {
        $request['code'] = $request['title'] . '-' . $request['start_date'] . '-' . $request['end_date'];

        $unique = EventModel::where('code', $request->code)->first();
        if ($unique) {
            return back()->with('error', "Error! Data already exists");
        } else {
            $validateData = $request->validate([
                'title' => 'required|max:60',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'color' => 'required',
                'description' => 'string',
            ]);
            $validateData['code'] = $request['code'];
            $validateData['edited_by'] = '05acd69d-9774-4e49-becb-437fcc703df9';
            $validateData['id'] = Str::uuid();

            if (EventModel::create($validateData)) {
                return back()->with('success', "Data added successfully!");
            } else {
                return back()->with('error', "Error! Failed to add the data");
            }
        }
    }

    public function eventUpdate(Request $request)
    {
        $enabled = EventModel::find($request->id);
        $duplicate = EventModel::withTrashed()->where('code', $request->code)->first();

        if ($duplicate == null) {
            $validateData = $request->validate([
                'title' => 'required|max:60',
                'start_date' => 'required|date',
                'end_date' => 'required|date',
                'color' => 'required',
                'description' => 'string',
            ]);
            $validateData['edited_by'] = '05acd69d-9774-4e49-becb-437fcc703df9';

            if (EventModel::where('id', $request->id)->update($validateData)) {
                return back()->with('success', 'Data updated successfully!');
            }
            return back()->with('error', "Error! Something went wrong");
        }
        return back()->with('error', 'Error! Data already exists');
    }

    public function eventDelete(Request $request)
    {
        if (EventModel::destroy($request->id)) {
            return back()->with('success', 'Data deleted successfully!');
        } else {
            return back()->with('error', 'Error! Failed to delete the data');
        }
    }
}