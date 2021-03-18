<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SizeCollection;
use App\Http\Resources\SizeResource;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{

    public function index()
    {
        return SizeCollection::make(Size::all());
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sizes|max:255',
        ]);
        $size = Size::create($request->all());
        return SizeResource::make($size);
    }

    public function show($id)
    {
        $size = Size::findOrFail($id);
        return SizeResource::make($size);
    }

    public function update(Request $request, $id)
    {
        $size = Size::findOrFail($id);
        $request->validate([
            'name' => 'required'
        ]);
        $size->update($request->all());
        return SizeCollection::make(Size::all());
    }

    public function destroy($id)
    {
        $size = Size::findOrFail($id);
        $size->delete();
        return response()->json("Completo",200);
    }
}
