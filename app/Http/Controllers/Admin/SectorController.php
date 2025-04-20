<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sector;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class SectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        $districts = District::all();
        return view('admin.sectors.create', compact('districts'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:sectors,name',
                'district_id' => 'required|exists:districts,id',
            ]);

            $sector = Sector::create([
                'name' => $request->name,
                'district_id' => $request->district_id,
            ]);

            return redirect()->route('dashboard')->with('success', 'Sector created successfully.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (QueryException $e) {
            return back()->with('error', 'Database error: ' . $e->getMessage())->withInput();
        }
    }
}