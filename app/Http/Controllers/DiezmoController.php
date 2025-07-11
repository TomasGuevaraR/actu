<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiezmoController extends Controller
{
    public function index()
    {
        return view('diezmo.index'); // Muestra todos los diezmos/ofrendas
    }

    public function create()
    {
        return view('diezmo.create');
    }

    public function store(Request $request)
    {
        // Lógica para guardar diezmo/ofrenda
    }
}
