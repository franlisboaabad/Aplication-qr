<?php

namespace App\Http\Controllers;

use App\Models\Codigo;
use Illuminate\Http\Request;

class CodigoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $codigos = Codigo::orderBy('created_at', 'desc')->paginate(10); // Obtener 10 registros por página

        return view('admin.codigos.index', compact('codigos'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'url' => 'required|url',
            'codigo_qr' => 'required|url',  // Asegurarse que la URL del código QR sea válida
        ]);

        // Obtener los datos del request
        $url = $request->input('url');
        $codigoQrUrl = $request->input('codigo_qr');  // La URL de la imagen generada

        // Guardar el código QR en la base de datos (por ejemplo, en un campo 'codigo_qr' de una tabla 'codigos')
        $codigo = new Codigo; // Asegúrate de tener el modelo correspondiente
        $codigo->url = $url; // Guardar el enlace
        $codigo->codigo_qr = $codigoQrUrl;  // Guardar la URL de la imagen
        $codigo->save();

        // Responder con éxito
        return response()->json(['message' => 'Código QR registrado exitosamente']);
    }


    public function show(Codigo $codigo)
    {
        //
    }


    public function edit(Codigo $codigo)
    {
        //
    }


    public function update(Request $request, Codigo $codigo)
    {
        //
    }


    public function destroy(Codigo $codigo)
    {
        // Invertir el valor de 'active' (0 -> 1 o 1 -> 0)
        $codigo->active = !$codigo->active;
        $codigo->save();

        // Regresar a la página anterior
        return back();
    }
}
