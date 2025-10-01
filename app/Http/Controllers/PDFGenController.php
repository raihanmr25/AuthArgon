<?php

namespace App\Http\Controllers;

use App\Models\BarangPemakaian;
use Illuminate\Http\Request;
use TCPDF;

class PDFGenController extends Controller
{
    // public function generatePDF() {
    //     $data = BarangPemakaian::all();

    //     if (!$data) {
    //         return response()->json(['error' => 'Data Kosong']);
    //     }
        
    //     $pdf = new TCPDF();
    //     $pdf->AddPage();
    //     $pdf->SetFont('helvetica', '', 12);

    //     foreach ($data as $item) {
    //         $logo = public_path('assets/Lambang_Kota_Semarang.png');
    //         $barcodepath = url('storage/barcode/' . $item['barcode'] . '.png');


    //         $html = '
    //                 <div style="display: flex; align-items: center;">
    //                     <table style="width: 45%; border-collapse: collapse;">
    //                         <tr>
    //                             <td style="border: 1px solid black; align-items: center;" rowspan="2">
    //                                 <img src="' . $logo . '" width="60" height="60" alt="Logo"><br>
    //                             </td>
    //                             <td style="border: 1px solid black;">
    //                                 ' . $item->nibar . '
    //                                 ' . $item['barcode'] . '
    //                             </td>
    //                         </tr>
    //                         <tr>
    //                             <td style="border: 1px solid black;">
    //                                 ' . $item->kode_barang . '
    //                             </td>
    //                         </tr>
    //                         <tr>
    //                             <td style="border: 1px solid black;" colspan="2">PEMERINTAH KOTA SEMARANG</td>
    //                         </tr>
    //                     </table>


    //                     <div style="width: 45%; text-align: center;">
    //                         <img src="file://' . $barcodepath . '" style="width: 100%; alt="Barcode">
    //                     </div>
    //                 </div>    
    //         ';

            

    //         $pdf->writeHTML($html, true, false, true, false, '');

    //     }

    //     // Output the PDF
    //     return $pdf->Output('AssetCard.pdf', 'I');
    // }

    // public function generatePDF() {
    //     $data = BarangPemakaian::chunk(100, function ($data) {
    //         if ($data->isEmpty()) {
    //             return response()->json(['error' => 'Data Kosong']);
    //         }

    //         $pdf = new TCPDF();
    //         $pdf->AddPage();
    //         $pdf->SetFont('helvetica', '', 12);
    //         // Ukuran kertas F4
    //         $html = '';

    //         foreach ($data as $item) {
    //             $logo = public_path('assets/Lambang_Kota_Semarang.png');
    //             $barcodepath = storage_path('app/public/barcode/' . $item['barcode'] . '.png');

    //             $html .= '
    //                 <table style="border-collapse: collapse; padding: 8px;">
    //                     <tr>
    //                         <td style="border: 0.3px dashed gray;">
    //                             <table style="border-collapse: collapse;">
    //                                 <tr>
    //                                     <td style="border: 1px solid black; width:15%;" rowspan="2" >
    //                                         <div>
    //                                             <img src="' . $logo . '" alt="Logo">
    //                                         </div>
    //                                     </td>
    //                                     <td style="border: 1px solid black; width: 75%;"><strong>' . $item->nibar . '</strong></td>
    //                                 </tr>
    //                                 <tr>
    //                                      <td style="border: 1px solid black; width: 75%;"><strong>' . $item->kode_barang . '</strong></td>
    //                                 </tr>
    //                                 <tr>
    //                                   <td style="border: 1px solid black; text-align: center;" colspan="2"><strong>PEMERINTAH KOTA SEMARANG</strong></td>
    //                                 </tr>
    //                             </table>
    //                         </td>
    //                         <td style="border: 0.3px dashed gray; ">
    //                             <table>
    //                                 <tr>
    //                                     <td>
    //                                         <div style=" text-align: center; ">
    //                                             <img src="' . $barcodepath . '" alt="Barcode">
    //                                         </div>
    //                                     </td>
    //                                 </tr>
    //                             </table>
    //                         </td>
    //                     </tr>
    //                 </table>


    //                 ';


    //         }

    //         $pdf->writeHTML($html, true, false, true, false, '');

    //         return $pdf->Output('AssetCard.pdf', 'I');
    //     });
    // }

    
    // Fixed Function
    public function generatePDF() {
        $data = BarangPemakaian::all(); // Get semua data 

        if ($data->isEmpty()) {
            return response()->json(['error' => 'Data Kosong']);
        }

        $pdf = new TCPDF();
        $pdf->setPrintHeader(false);
        $pdf->SetFont('helvetica', '', 13);
        $pdf->setMargins(4,4,4);
        $pdf->AddPage('P', array(210,330)); // Ukuran Kertas F4

        $logo = public_path('assets/Lambang_Kota_Semarang.png');
        
        // Jumlah item per halaman
        $counter = 0;
        $itemsPerPage = 14;

        $html = '';
        foreach ($data as $item) {
            $barcodepath = storage_path('app/public/barcode/' . $item['barcode'] . '.png');

            $html .= '
                <table style="border-collapse: collapse; border-bottom: 0.1px dashed gray; border-top: 0.1px dashed gray; padding: 6px 6px 0px 2px;">
                    <tr>
                        <td style=" border-bottom:none; border-left: 0.1px dashed gray; border-right: 0.1px dashed gray;">
                            <table style="border-collapse: collapse;">
                                <tr>
                                    <td style="border: 1px solid black; text-align: center; width:15%;" rowspan="2" >
                                        <img src="' . $logo . '" alt="Logo" width="25px" top="2px">
                                    </td>
                                    <td style="border: 1px solid black; width: 85%; text-align: center;"><strong>' . $item->nibar . '</strong></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; width: 85%; text-align: center; "><strong>' . $item->kode_barang . '</strong></td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid black; height: 8px; text-align: center; font-size:10px;" colspan="3"><strong>PEMERINTAH KOTA SEMARANG</strong></td>
                                </tr>
                            </table>
                        </td>
                        <td style=" border-bottom:none; border-right: 0.1px dashed gray;">
                            <table>
                                <tr>
                                    <td>
                                        <img src="' . $barcodepath . '" style="height: 75px; width: 400px;" alt="Barcode">
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            ';

            // Counter item untuk membuat new page
            $counter++;
            if ($counter % $itemsPerPage == 0) {
                $pdf->writeHTML($html, true, false, true, false, '');
                $pdf->AddPage();
                $html = ''; 
            }
        }

        if (!empty($html)) {
            $pdf->writeHTML($html, true, false, true, false, '');
        }

        return $pdf->Output('AssetCard.pdf', 'I');

    }


}




        // $html = '
        //     <table style="width: 50%; border: 0;x">
        //         <tr>
        //             <!-- Left Column: Logo, ID, and Number -->
        //             <td style="width: 45%; vertical-align: top;">
        //                 <img src="' . $logo . '" width="100" height="100" alt="Logo"><br>
        //                 <strong>ID:</strong> ' . $item->nibar . '<br>
        //                 <strong>Nama Barang:</strong> ' . $item->nama_barang . '<br>
        //                 <strong>PEMERINTAH KOTA SEMARANG</strong>
        //             </td>
        //             <!-- Right Column: Barcode -->
        //             <td style="width: 45%; vertical-align: top; text-align: center;">
                    //     ';

                    // if (file_exists($barcodepath)) {
                    //     $html .= '<img src="file://' . $barcodepath . '" width="150" height="50" alt="Barcode">';
                    // } else {
                    //     $html .= '<strong>Data barcode tidak ditemukan</strong>';
                    // }

                    // $html .= '
        //             </td>
        //         </tr>
        //     </table>
        // ';