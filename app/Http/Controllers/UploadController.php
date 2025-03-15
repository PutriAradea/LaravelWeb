<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image; 
use Intervention\Image\ImageManager;

class UploadController extends Controller
{
    public function upload()
    {
        return view('upload');
    }

    public function proses_upload(Request $request)
    {
        $this->validate($request, [
            'file' => 'required',
            'keterangan' => 'required',
        ]);

        // Menyimpan data file yang diupload ke variabel $file
        $file = $request->file('file');

        // Nama file
        echo 'File Name: ' . $file->getClientOriginalName() . '<br>';

        // Ekstensi file
        echo 'File Extension: ' . $file->getClientOriginalExtension() . '<br>';

        // Real path
        echo 'File Real Path: ' . $file->getRealPath() . '<br>';

        // Ukuran file
        echo 'File Size: ' . $file->getSize() . '<br>';

        // Tipe MIME
        echo 'File Mime Type: ' . $file->getMimeType();

        // Tentukan folder tujuan penyimpanan
        $tujuan_upload = 'data_file';

        // Upload file ke folder tujuan
        $file->move($tujuan_upload, $file->getClientOriginalName());
    }
    public function resize_upload(Request $request)
{
    $this->validate($request, [
        'file' => 'required',
        'keterangan' => 'required',
    ]);

    // TENTUKAN PATH LOKASI UPLOAD
    $path = public_path('img/logo');

    // JIKA FOLDERNYA BELUM ADA
    if (!File::isDirectory($path)) {
        // MAKA FOLDER TERSEBUT AKAN DIBUAT
        File::makeDirectory($path, 0777, true);
    }

    // MENGAMBIL FILE IMAGE DARI FORM
    $file = $request->file('file');

    // MEMBUAT NAMA FILE DARI GABUNGAN TANGGAL DAN UNIQUE ID
    $fileName = 'logo_' . uniqid() . '.' . $file->getClientOriginalExtension();

    // MEMBUAT CANVAS IMAGE SEBESAR DIMENSI
    $canvas = Image::canvas(200, 200);

    // RESIZE IMAGE SESUAI DIMENSI DENGAN MEMPERTAHANKAN RATIO
    $resizeImage = Image::make($file)->resize(null, 200, function ($constraint) {
        $constraint->aspectRatio();
    });

    // MEMASUKAN IMAGE YANG TELAH DIRESIZE KE DALAM CANVAS
    $canvas->insert($resizeImage, 'center');

    // SIMPAN IMAGE KE FOLDER
    if ($canvas->save($path . '/' . $fileName)) {
        return redirect(route('upload'))->with('success', 'Data berhasil ditambahkan!');
    } else {
        return redirect(route('upload'))->with('error', 'Data gagal ditambahkan!');
    }
}

    // Acara 20: ke 1 Tambahkan function dropzone dan dropzone_store
    public function dropzone()
    {
        return view('dropzone');
    }

    public function dropzone_store(Request $request)
    {
        $image = $request->file('file');
        $imageName = time() . '-' . $image->getClientOriginalName();
        $image->move(public_path('img/dropzone'), $imageName);

        return response()->json(['success' => $imageName]);
    }

     // Menampilkan halaman upload
     public function pdf_upload()
     {
         return view('pdf_upload');
     }
 
     // Menyimpan file yang diunggah
     public function pdf_store(Request $request)
     {
         // Validasi file harus PDF dan maksimal 2MB
         $request->validate([
             'file' => 'required|mimes:pdf|max:2048',
         ]);
 
         // Ambil file dari request
         $pdf = $request->file('file');
 
         // Buat nama unik berdasarkan timestamp
         $pdfName = time() . '.' . $pdf->getClientOriginalExtension();
 
         // Simpan ke folder public/pdf/dropzone
         $pdf->move(public_path('pdf/dropzone'), $pdfName);
 
         // Berikan respons JSON ke Dropzone
         return response()->json(['success' => $pdfName]);
     }
 }
