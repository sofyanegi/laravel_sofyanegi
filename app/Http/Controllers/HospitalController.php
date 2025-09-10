<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;

class HospitalController extends Controller
{
    public function index()
    {
        $hospitals = Hospital::latest()->paginate(10);
        return view('hospital.index', compact('hospitals'));
    }

    public function create()
    {
        return view('hospital.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address'  => 'required|string',
            'email'   => 'required|email|unique:hospitals',
            'telephone' => 'required|string|max:20',
        ]);

        Hospital::create($request->all());

        return redirect()->route('hospital.index')->with('success', 'Rumah sakit berhasil ditambahkan.');
    }

    public function edit(Hospital $hospital)
    {
        return view('hospital.edit', compact('hospital'));
    }

    public function update(Request $request, Hospital $hospital)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address'  => 'required|string',
            'email'   => 'required|email|unique:hospitals,email,' . $hospital->id,
            'telephone' => 'required|string|max:20',
        ]);

        $hospital->update($request->all());

        return redirect()->route('hospital.index')->with('success', 'Rumah sakit berhasil diperbarui.');
    }

    public function destroy(Hospital $hospital)
    {
        $hospital->delete();
        if (request()->ajax()) {
            return response()->json(['message' => 'Rumah sakit berhasil dihapus.']);
        }
        return redirect()->route('hospital.index')->with('success', 'Rumah sakit berhasil dihapus.');
    }
}
