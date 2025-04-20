<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['store', 'getProvinces', 'create']);
    }

    public function index()
    {
        $provinces = Province::all();
        return view('admin.provinces.index', compact('provinces'));
    }

    public function create()
    {
        return view('admin.provinces.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255|unique:provinces,name',
            ]);

            $province = Province::create([
                'name' => $request->name,
            ]);

            if ($request->expectsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Province created successfully!',
                    'province' => $province,
                ], 201);
            }

            return redirect()->route('admin.provinces.index')->with('success', 'Province created successfully.');
        } catch (ValidationException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed: ' . $e->errors()['name'][0],
                ], 422);
            }
            throw $e;
        } catch (QueryException $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Database error: ' . $e->getMessage(),
                ], 500);
            }
            throw $e;
        }
    }

    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

    public function show(Province $province)
    {
        return view('admin.provinces.show', compact('province'));
    }

    public function edit(Province $province)
    {
        return view('admin.provinces.edit', compact('province'));
    }

    public function update(Request $request, Province $province)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:provinces,name,' . $province->id,
        ]);

        $province->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.provinces.index')->with('success', 'Province updated successfully.');
    }

    public function destroy(Province $province)
    {
        $province->delete();
        return redirect()->route('admin.provinces.index')->with('success', 'Province deleted successfully.');
    }
}