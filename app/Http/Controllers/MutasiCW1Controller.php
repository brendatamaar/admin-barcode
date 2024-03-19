<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiCW1;
use App\Http\Requests\UpdateMutasiCW1Request;
use App\Imports\MutasiCW1Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiCW1Controller extends Controller
{
    /**
     * Instantiate a new MutasiCW1 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-cw1', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_cw1.index', [
            'mutasi_cw1' => MutasiCW1::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiCW1 $mutasi_cw1): View
    {
        return view('products.show', [
            'mutasi_cw1' => $mutasi_cw1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiCW1 $mutasi_cw1): RedirectResponse
    {
        $mutasi_cw1->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiCW1 $mutasi_cw1): RedirectResponse
    {
        $mutasi_cw1->truncate();
        return redirect()->route('mutasi_cw1.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiCW1Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('mutasi_cw1')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_cw1')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
    }

    public function downloadImportTemplate()
    {
        $path = base_path('/template/mutasi_cw.xls');;

        return response()->download($path, 'mutasi_cw.xls', [
            'Content-Type' => 'text/xls',
        ]);
    }


    public function cetakBarcode()
    {
        $dataproduk = MutasiCW1::all()->groupBy('no_kertas')->toArray(); 
        
        $pdf = PDF::loadView('mutasi_cw1.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_cw1.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiCW1::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_cw1.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_cw1.pdf');
    }
}
