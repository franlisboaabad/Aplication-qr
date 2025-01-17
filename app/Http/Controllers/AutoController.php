<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormAutoRequest;
use App\Models\Auto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;



class AutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autos = Auto::get();

        return view('admin.moviles.index', compact('autos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.moviles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormAutoRequest $request)
    {

        // dd($request->all());
        $auto = Auto::create(
            [
                'slug' => Str::slug($request->modelo)
            ] + $request->all()
        );
        if ($request->file('imagen_principal')) {
            $auto->imagen_principal = $request->file('imagen_principal')->store('autos', 'public');
            $auto->save();
        }
        return back()->with('success', 'Auto registrado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function show(Auto $auto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function edit(Auto $auto)
    {
        return view('admin.moviles.edit', compact('auto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function update(FormAutoRequest $request, Auto $auto)
    {
        $auto->update($request->all());

        if ($request->file('imagen_principal')) {
            Storage::disk('public')->delete($auto->imagen_principal);
            $auto->imagen_principal = $request->file('imagen_principal')->store('autos', 'public');
        }
        $auto->save();

    
        return back()->with('success', 'Auto editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Auto $auto)
    {
        $auto->delete();
        return back()->with('success', 'Registro eliminado con éxito');
    }
}
