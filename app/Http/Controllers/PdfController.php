<?php

namespace App\Http\Controllers;

use Dompdf\Dompdf;
use App\Models\Menu;
use Carbon\Traits\Options;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PdfController extends Controller
{
    //


    public function descargar_carta_qr(Menu $menu)
    {
        dd($menu);

        // $qrCode = QrCode::size(500)->generate($menu->id);
        
        // $data = [ 'titulo' => $menu->nombre_empresa, 'qrCode' => 'data:image/png;base64,' . base64_encode($qrCode)];

        // $dompdf = new Dompdf();

        // // Renderiza la vista en PDF
        // $dompdf->loadHtml(view('carta', $data));

        // // Opcionalmente, puedes establecer opciones adicionales para el tamaño del papel y la orientación:
        // $dompdf->setPaper('A4', 'portrait'); // Cambia el tamaño del papel y la orientación según tus necesidades

        // // Renderiza el PDF
        // $dompdf->render();

        // // Obtén el contenido del PDF
        // $pdfContent = $dompdf->output();

        // // Devuelve el PDF en una nueva ventana (_blank)
        // return response($pdfContent)
        //     ->header('Content-Type', 'application/pdf')
        //     ->header('Content-Disposition', 'inline; filename="' . $menu->nombre_empresa . '.pdf"')
        //     ->header('target', '_blank');
    }
}
