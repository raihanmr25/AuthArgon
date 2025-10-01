<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BarangPemakaian;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;

class BarangPemakaianSeeder extends Seeder
{
    
    public function run(): void
    {
        $file = database_path('data/12.csv');

        if (!file_exists($file)) {
            echo "❌ CSV file tidak ditemukan: $file\n";
            return;
        }

        $csv = fopen($file, 'r');
        $header = fgetcsv($csv);

        

        while (($row = fgetcsv($csv)) !== false) {
            $data = array_combine($header, $row);

            $dataToInsert = [
                'nibar' => $this->fixScientific($data['nibar'] ?? ''),
                'kode_barang' => $data['kode_barang'] ?? null,
                'nama_barang' => $data['nama_barang'] ?? null,
                'spesifikasi_nama_barang' => $data['spesifikasi_nama_barang'] ?? null,
                'lokasi' => $data['lokasi'] ?? null,
                'nama_pemakai' => $data['nama_pemakai'] ?? null,
                'status_pemakai' => $data['status_pemakai'] ?? null,
                'jabatan' => $data['jabatan'] ?? null,
                'nomor_identitas_pemakai' => $this->fixScientific($data['nomor_identitas_pemakai'] ?? ''),
                'alamat_pemakai' => $data['alamat_pemakai'] ?? null,
                'bast_nomor' => $data['bast_nomor'] ?? null,
                'bast_tanggal' => $this->convertDate($data['bast_tanggal'] ?? ''),
                'dokumen_nama' => $data['dokumen_nama'] ?? null,
                'dokumen_nomor' => $data['dokumen_nomor'] ?? null,
                'dokumen_tanggal' => $this->convertDate($data['dokumen_tanggal'] ?? ''),
                'keterangan' => $data['keterangan'] ?? null,
                'no_simda' => $data['no_simda'] ?? null,
                'new' => $data['new'] ?? null,
                'tahun' => $data['tahun'] ?? null,
                'no_mesin' => $data['no_mesin'] ?? null,
            ];

            // === QR Code generation ===
            // $qrContent = json_encode([
            //     'nibar' => $dataToInsert['nibar'],
            //     'kode_barang' => $dataToInsert['kode_barang'],
            //     'nama_barang' => $dataToInsert['nama_barang'],
            //     'lokasi' => $dataToInsert['lokasi'],
            //     'tahun' => $dataToInsert['tahun'],
            //     'nama_pemakai' => $dataToInsert['nama_pemakai'],
            //     'status_pemakai' => $dataToInsert['status_pemakai'],
            //     'jabatan' => $dataToInsert['jabatan'],
            //     'link' => url('/qr/item/' . $dataToInsert['nibar']),
            // ], JSON_PRETTY_PRINT);

            // $filename = 'qr_' . uniqid() . '.svg';
            // $qrPath = "qr-codes/{$filename}";

            // Storage::disk('public')->put($qrPath, QrCode::format('svg')->size(300)->generate($qrContent));

            // $dataToInsert['qr_path'] = $qrPath;


            // === QR Code generation ===
            $barcodecontent = json_encode([
                'nibar' => $dataToInsert['nibar'],
                'kode_barang' => $dataToInsert['kode_barang'],
                'nama_barang' => $dataToInsert['nama_barang'],
                'lokasi' => $dataToInsert['lokasi'],
                'tahun' => $dataToInsert['tahun'],
                'nama_pemakai' => $dataToInsert['nama_pemakai'],
                'status_pemakai' => $dataToInsert['status_pemakai'],
                'jabatan' => $dataToInsert['jabatan'],
                'link' => url('/qr/item/' . $dataToInsert['nibar']),
            ], JSON_PRETTY_PRINT);

            // Barcode
            if (empty($dataToInsert['barcode'])) {
                $dataToInsert['barcode'] = 'ASSET-' . strtoupper(Str::random(8));
            }

            $encodedContent = base64_encode($barcodecontent);
            
            $barcodeGen = new DNS1D();
            $png = $barcodeGen->getBarcodePNG($dataToInsert['barcode'], 'C128');
            $filename = 'barcode/' . $dataToInsert['barcode'] . '.png';

            

            Storage::disk('public')->put($filename, base64_decode($png));
            BarangPemakaian::create($dataToInsert);
        }

        fclose($csv);

        echo "✅ Seeder BarangPemakaian berhasil dijalankan.\n";
    }

    private function fixScientific($value)
    {
        if (strpos(strtoupper($value), 'E+') !== false) {
            return number_format((float)$value, 0, '', '');
        }
        return $value;
    }

    private function convertDate($value)
    {
        if (empty(trim($value))) return null;

        $bulan = [
            'Januari' => '01', 'Februari' => '02', 'Maret' => '03',
            'April' => '04', 'Mei' => '05', 'Juni' => '06',
            'Juli' => '07', 'Agustus' => '08', 'September' => '09',
            'Oktober' => '10', 'November' => '11', 'Desember' => '12',
        ];

        foreach ($bulan as $indo => $num) {
            if (strpos($value, $indo) !== false) {
                $value = str_replace($indo, $num, $value);
                break;
            }
        }

        try {
            return Carbon::createFromFormat('d m Y', $value)->toDateString();
        } catch (\Exception $e) {
            return null;
        }
    }
}
