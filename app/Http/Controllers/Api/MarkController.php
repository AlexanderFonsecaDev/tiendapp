<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MarkCollection;
use App\Http\Resources\MarkResource;
use App\Models\Mark;
use Illuminate\Http\Request;

class MarkController extends Controller
{

    public function index()
    {
        return MarkCollection::make(Mark::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:marks|max:255',
            'reference' => 'required|max:255',
        ]);
        $mark = Mark::create($request->all());
        return MarkResource::make($mark);
    }

    public function show($id)
    {
        $mark = Mark::findOrFail($id);
        return MarkResource::make($mark);
    }

    public function update(Request $request, $id)
    {
        $mark = Mark::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255',
            'reference' => 'required|max:255',
        ]);
        $mark->update($request->all());
        return MarkCollection::make(Mark::all());
    }

    public function destroy($id)
    {
        $mark = Mark::findOrFail($id);
        $mark->delete();
        return response()->json("Completo",200);
    }
}
