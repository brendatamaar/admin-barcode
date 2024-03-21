<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiTagBin2;
use App\Http\Requests\UpdateMutasiTagBin2Request;
use App\Imports\MutasiTagBin2Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiTagBin2Controller extends Controller
{
    /**
     * Instantiate a new MutasiTagibin2 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-tag-bin2', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll', 'importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_tag_bin2.index', [
            'mutasi_tag_bin2' => MutasiTagBin2::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiTagBin2 $mutasi_tag_bin2): View
    {
        return view('products.show', [
            'mutasi_tag_bin2' => $mutasi_tag_bin2
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiTagBin2 $mutasi_tag_bin2): RedirectResponse
    {
        $mutasi_tag_bin2->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiTagBin2 $mutasi_tag_bin2): RedirectResponse
    {
        $mutasi_tag_bin2->truncate();
        return redirect()->route('mutasi_tag_bin2.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiTagBin2Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('mutasi_tag_bin2')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_tag_bin2')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
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
        $dataproduk = MutasiTagBin2::all()->toArray();
        $no  = 1;
        $pdf = PDF::loadView('mutasi_tag_bin2.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_barcode_lokasi2.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiTagBin2::all()->toArray();
        $no  = 1;
        $pdf = PDF::loadView('mutasi_tag_bin2.qr', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_barcode_lokasi2.pdf');
    }
}
