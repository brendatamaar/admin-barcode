<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiCW2;
use App\Http\Requests\UpdateMutasiCW2Request;
use App\Imports\MutasiCW2Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiCW2Controller extends Controller
{
    /**
     * Instantiate a new MutasiCW2 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-cw2', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_cw2.index', [
            'mutasi_cw2' => MutasiCW2::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiCW2 $mutasi_cw2): View
    {
        return view('products.show', [
            'mutasi_cw2' => $mutasi_cw2
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiCW2 $mutasi_cw2): RedirectResponse
    {
        $mutasi_cw2->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiCW2 $mutasi_cw2): RedirectResponse
    {
        $mutasi_cw2->truncate();
        return redirect()->route('mutasi_cw2.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiCW2Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('mutasi_cw2')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_cw2')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
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
        $dataproduk = MutasiCW2::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_cw2.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_cw2.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiCW2::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_cw2.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_cw2.pdf');
    }
}
