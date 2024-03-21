<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiCW5;
use App\Imports\MutasiCW5Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiCW5Controller extends Controller
{
    /**
     * Instantiate a new MutasiCW5 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-cw5', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll', 'importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_cw5.index', [
            'mutasi_cw5' => MutasiCW5::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiCW5 $mutasi_cw5): View
    {
        return view('products.show', [
            'mutasi_cw5' => $mutasi_cw5
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiCW5 $mutasi_cw5): RedirectResponse
    {
        $mutasi_cw5->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiCW5 $mutasi_cw5): RedirectResponse
    {
        $mutasi_cw5->truncate();
        return redirect()->route('mutasi_cw5.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiCW5Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('mutasi_cw5')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_cw5')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
    }

    public function downloadImportTemplate()
    {
        $path = base_path('/template/mutasi_cw5.xls');;

        return response()->download($path, 'mutasi_wtb5.xls', [
            'Content-Type' => 'text/xls',
        ]);
    }


    public function cetakBarcode()
    {
        $dataproduk = MutasiCW5::all()->groupBy('category');
        $no  = 1;
        $pdf = PDF::loadView('mutasi_cw5.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_wtb5.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiCW5::all()->groupBy('category');
        $no  = 1;
        $pdf = PDF::loadView('mutasi_cw5.qr', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'landscape');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_wtb5.pdf');
    }
}
