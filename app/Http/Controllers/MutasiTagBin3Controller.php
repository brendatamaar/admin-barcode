<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiTagBin3;
use App\Http\Requests\UpdateMutasiTagBin3Request;
use App\Imports\MutasiTagBin3Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiTagBin3Controller extends Controller
{
    /**
     * Instantiate a new MutasiTagibin3 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-tag-bin3', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll', 'importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_tag_bin3.index', [
            'mutasi_tag_bin3' => MutasiTagBin3::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiTagBin3 $mutasi_tag_bin3): View
    {
        return view('products.show', [
            'mutasi_tag_bin3' => $mutasi_tag_bin3
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiTagBin3 $mutasi_tag_bin3): RedirectResponse
    {
        $mutasi_tag_bin3->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiTagBin3 $mutasi_tag_bin3): RedirectResponse
    {
        $mutasi_tag_bin3->truncate();
        return redirect()->route('mutasi_tag_bin3.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiTagBin3Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('mutasi_tag_bin3')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_tag_bin3')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
    }

    public function downloadImportTemplate()
    {
        $path = base_path('/template/mutasi_barcode_lokasi.xls');;

        return response()->download($path, 'mutasi_barcode_lokasi.xls', [
            'Content-Type' => 'text/xls',
        ]);
    }


    public function cetakBarcode()
    {
        $dataproduk = MutasiTagBin3::all()->toArray();
        $no  = 1;
        $pdf = PDF::loadView('mutasi_tag_bin3.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_barcode_lokasi3.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiTagBin3::all()->toArray();
        $no  = 1;
        $pdf = PDF::loadView('mutasi_tag_bin3.qr', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_barcode_lokasi3.pdf');
    }
}
