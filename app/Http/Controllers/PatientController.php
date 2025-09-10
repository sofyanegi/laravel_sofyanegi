<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::with('hospital')->paginate(10);
        $hospitals = Hospital::all();
        return view('patient.index', compact('patients', 'hospitals'));
    }

    public function create()
    {
        $hospitals = Hospital::all();
        return view('patient.create', compact('hospitals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:20',
            'id_hospital' => 'required|exists:hospitals,id'
        ]);

        Patient::create($request->all());

        return redirect()->route('patient.index')->with('success', 'Pasien berhasil ditambahkan!');
    }

    public function edit(Patient $patient)
    {
        $hospitals = Hospital::all();
        return view('patient.edit', compact('patient', 'hospitals'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'telephone_number' => 'required|string|max:20',
            'id_hospital' => 'required|exists:hospitals,id'
        ]);

        $patient->update($request->all());

        return redirect()->route('patient.index')->with('success', 'Pasien berhasil diperbarui.');
    }

    public function destroy(Patient $patient)
    {
        $patient->delete();
        if (request()->ajax()) {
            return response()->json(['message' => 'Pasien berhasil dihapus.']);
        }
        return redirect()->route('patient.index')->with('success', 'Pasien berhasil dihapus.');
    }

    public function filter($hospitalId)
    {
        $query = Patient::with('hospital');
        if ($hospitalId != 'all') {
            $query->where('id_hospital', $hospitalId);
        }
        return response()->json($query->get());
    }
}
