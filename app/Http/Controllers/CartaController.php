<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Carta;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CartaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cartas = Carta::paginate(10);
        return view('admin.cartas.index', compact('cartas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cartas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:cartas,slug', // El slug debe ser único solo al crear la carta
            'carta_path' => 'required|file|mimes:pdf|max:4096', // Tamaño máximo de 4MB (4096 KB)
        ]);

        // Obtener solo los campos necesarios del formulario
        // $data = $request->only(['nombre_empresa']);

        // Crear el registro en la base de datos
        $carta = Carta::create($request->all() + ['slug' => Str::slug($request->nombre_empresa)]);

        if ($request->file('carta_path')) {
            // Guardar el archivo PDF en la carpeta public/cartas/
            $cartaPath = $request->file('carta_path')->store('cartas', 'public');

            // Asignar la ruta del archivo PDF a ambos campos
            $carta->carta_path = $cartaPath;
            $carta->save();
        }

        return back()->with('success', 'Carta digital registrada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function show(Carta $carta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function edit(Carta $carta)
    {
        return view('admin.cartas.edit', compact('carta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carta $carta)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'carta_path' => 'required|file|mimes:pdf|max:4096', // Tamaño máximo de 4MB (4096 KB)
        ]);

        // Actualizar el nombre de la empresa solo si ha cambiado
        $carta->update($request->all() + ['slug' => Str::slug($request->nombre_empresa)]);



        // Verificar si el campo carta_path ha sido enviado
        if ($request->hasFile('carta_path')) {
            // Eliminar el archivo PDF existente del disco si existe
            if ($carta->carta_path && Storage::disk('public')->exists($carta->carta_path)) {
                Storage::disk('public')->delete($carta->carta_path);
            }

            // Cargar y guardar el nuevo archivo PDF en el disco
            $carta->carta_path = $request->file('carta_path')->store('cartas', 'public');


            // Guardar los cambios en la base de datos
            $carta->save();
        }

        return back()->with('success', 'Carta digital actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Carta  $carta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carta $carta)
    {
        // Verifica si el archivo existe antes de eliminarlo
        if ($carta->carta_path && Storage::disk('public')->exists($carta->carta_path)) {
            Storage::disk('public')->delete($carta->carta_path);
        }
        $carta->delete();
        return back();
    }

    /**
     * Cartas digitales
     */

    public function generar_codigo_qr(Carta $carta)
    {

        // Obtén el invitado desde la base de datos
        $invitado = Carta::findOrFail($carta->id);
        $urlRegistro = route('cartas.validar-codigo-qr', $invitado->slug); // Genera la URL de registro utilizando el nombre de la ruta y el ID del invitado
        $qrCode = QrCode::size(500)->generate($urlRegistro);


        // $qrCode = QrCode::size(500)->generate($carta->slug);

        $data = ['nombre_empresa' => $carta->nombre_empresa, 'qrCode' => 'data:image/png;base64,' . base64_encode($qrCode)];

        $dompdf = new Dompdf();

        // Renderiza la vista en PDF
        $dompdf->loadHtml(view('documentos.codigo-qr', $data));

        // Opcionalmente, puedes establecer opciones adicionales para el tamaño del papel y la orientación:
        $dompdf->setPaper('A4', 'portrait'); // Cambia el tamaño del papel y la orientación según tus necesidades

        // Renderiza el PDF
        $dompdf->render();

        // Obtén el contenido del PDF
        $pdfContent = $dompdf->output();

        // Devuelve el PDF en una nueva ventana (_blank)
        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'inline; filename="' . $carta->nombre_empresa . '.pdf"')
            ->header('target', '_blank');
    }


    /**
     * Cartas digitals, validar el codigo qr por slug  y mostrar el archivo adjunto
     */
    public function validar_codigo_qr($slug)
    {

        $carta = Carta::where('slug', $slug)->first();

        if (!$carta) {
            return abort(404); // O alguna otra respuesta si la carta no se encuentra
        }

        // Obtener la ruta completa del archivo PDF
        $cartaPath = public_path('storage/' . $carta->carta_path);

        // Verificar si el archivo existe
        if (!file_exists($cartaPath)) {
            return abort(404); // O alguna otra respuesta si el archivo no existe
        }

        // Obtener el contenido del PDF para mostrarlo en una nueva ventana
        $content = file_get_contents($cartaPath);

        // Generar una nueva respuesta con el contenido del PDF
        $response = new Response($content, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="carta.pdf"', // Nombre del archivo al mostrarlo en el navegador
        ]);

        return $response;
    }
}
