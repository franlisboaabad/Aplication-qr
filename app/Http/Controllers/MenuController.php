<?php

namespace App\Http\Controllers;

use App\Models\Menu;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::paginate(10);
        return view('admin.menus.index', compact('menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.menus.create');
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
            'carta_path' => 'required|file|mimes:pdf|max:4096', // Tamaño máximo de 4MB (4096 KB)
        ]);

        // Obtener solo los campos necesarios del formulario
        // $data = $request->only(['nombre_empresa']);

        // Crear el registro en la base de datos
        $carta = Menu::create($request->all() + ['slug' => Str::slug($request->nombre_empresa)]);

        if ($request->file('carta_path')) {
            // Guardar el archivo PDF en la carpeta public/cartas/
            $cartaPath = $request->file('carta_path')->store('cartas', 'public');

            // Asignar la ruta del archivo PDF a ambos campos
            $carta->carta_path = $cartaPath;
            $carta->carta_path_actual = $cartaPath;
            $carta->save();
        }

        return back()->with('success', 'Carta digital registrada con éxito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
        // dd($menu);
        return view('admin.menus.show', compact('menu'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        return view('admin.menus.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {

        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'carta_path' => 'required|file|mimes:pdf|max:4096', // Tamaño máximo de 4MB (4096 KB)
        ]);

        // Verificar si el campo carta_path ha sido enviado
        if ($request->hasFile('carta_path')) {
            // Eliminar el archivo PDF existente del disco si existe
            if ($menu->carta_path && Storage::disk('public')->exists($menu->carta_path)) {
                Storage::disk('public')->delete($menu->carta_path);
            }

            // Cargar y guardar el nuevo archivo PDF en el disco
            $menu->carta_path_actual = $request->file('carta_path')->store('cartas', 'public');
        }

        // Actualizar el nombre de la empresa solo si ha cambiado
        $menu->update($request->all() + ['slug' => Str::slug($request->nombre_empresa)]);


        // if ($menu->nombre_empresa !== $request->input('nombre_empresa')) {
        //     $menu->nombre_empresa = $request->input('nombre_empresa');
        // }

        // Guardar los cambios en la base de datos
        $menu->save();

        return back()->with('success', 'Carta digital actualizada con éxito.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Menu $menu)
    {
        // Verifica si el archivo existe antes de eliminarlo
        if ($menu->carta_path && Storage::disk('public')->exists($menu->carta_path)) {
            Storage::disk('public')->delete($menu->carta_path);
        }
        $menu->delete();
        return back();
    }


    /**
     * codigo para genear qr
     */


    public function generar_qr()
    {
        return view('admin.menus.generar-qr');
    }

    public function generar_qr_carta(Request $request)
    {
        // // Obtener el valor del input enviado mediante AJAX
        // $url = $request->input('url');

        // // Generar el código QR utilizando SimpleSoftwareIO\QrCode
        // $qrCode = QrCode::size(300)
        //     ->style('square')
        //     ->generate($url);

        // // Devolver el código QR como una respuesta de tipo imagen/png
        // return response($qrCode)->header('Content-Type', 'image/png');


        // Obtener el valor del input enviado mediante AJAX
        $url = $request->input('url');

        // Generar el código QR utilizando SimpleSoftwareIO\QrCode
        $qrCode = QrCode::size(300)
            ->style('square')
            ->generate($url);

        // Definir la ruta donde se guardará la imagen
        $path = public_path('images/qrcodes/'); // Carpeta 'images/qrcodes' dentro de 'public'

        // Asegurarse de que la carpeta exista, si no, crearla
        if (!file_exists($path)) {
            mkdir($path, 0777, true); // Crear la carpeta y sus subcarpetas si no existen
        }

        // Definir el nombre del archivo, puede ser dinámico si lo deseas
        $fileName = 'qr_code_' . time() . '.svg';

        // Guardar el código QR como una imagen PNG
        file_put_contents($path . $fileName, $qrCode);

        // Devolver la imagen generada y también la información en JSON
        $imageUrl = url('images/qrcodes/' . $fileName); // Obtener la URL pública del archivo


        // Aquí retornamos dos cosas: la imagen y un mensaje JSON con los detalles
        return response()->json([
            'message' => 'Código QR guardado exitosamente',
            'file' => $fileName,
            'image_url' => $imageUrl
        ]);
    }



    // Método para generar y almacenar el código QR
    // private function generateQRCode($content, $menuId)
    // {
    //     $qrCode = QrCode::size(300)->generate($content);

    //     Storage::put("public/qr_codes/{$menuId}.png", $qrCode);
    // }


    public function generateQrCode(Menu $menu)
    {

        // Buscar el menú por su ID
        $menu = Menu::findOrFail($menu->id);
        // // Obtener el contenido del código QR desde el campo carta_path
        $qrCodeContent = asset('storage/' . $menu->slug);
        // // Generar el código QR
        $qrCode = QrCode::size(300)->generate($qrCodeContent);

        // // Mostrar el código QR en la vista
        // return response($qrCode)->header('Content-Type', 'image/png');

        return view('admin.menus.qr', compact('qrCode'));
    }
}
