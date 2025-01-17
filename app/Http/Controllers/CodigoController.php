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
        //
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos
            $request->validate([
                'url' => 'required|url',
                'codigo_qr' => 'required'
            ]);

            // Crear un nuevo registro de código QR en la base de datos
            $codigo = new Codigo();
            $codigo->link = $request->input('url');
            $codigo->codigo_qr = $request->input('codigo_qr'); // Guardar el QR en formato base64
            $codigo->save();

            return response()->json(['message' => 'Código QR registrado exitosamente']);
        } catch (\Exception $ex) {
            // Capturar cualquier error y devolver un mensaje de error
            return response()->json([
                'error' => 'Hubo un error al registrar el código QR.',
                'details' => $ex->getMessage() // Aquí puedes incluir el detalle del error si es necesario
            ], 500); // Código 500 indica un error del servidor
        }
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
        //
    }
}
