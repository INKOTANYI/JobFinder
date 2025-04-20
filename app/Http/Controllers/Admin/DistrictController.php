<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $provinces = Province::all();
        return view('admin.districts.create', compact('provinces'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:districts,name',
                'province_id' => 'required|exists:provinces,id',
            ]);

            $district = District::create([
                'name' => $request->name,
                'province_id' => $request->province_id,
            ]);

            return redirect()->route('dashboard')->with('success', 'District created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
        }
    }
}