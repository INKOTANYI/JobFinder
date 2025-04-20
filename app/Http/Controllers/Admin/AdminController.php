<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Province;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function storeProvince(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:provinces,name',
        ]);

        $province = Province::create([
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Province created successfully!',
            'province' => $province,
        ], 201);
    }

    public function getProvinces()
    {
        $provinces = Province::all();
        return response()->json($provinces);
    }

}
