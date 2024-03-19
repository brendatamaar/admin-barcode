<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiD1;
use App\Http\Requests\UpdateMutasiD1Request;
use App\Imports\MutasiD1Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiD1Controller extends Controller
{
    /**
     * Instantiate a new MutasiD1 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-d1', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_d1.index', [
            'mutasi_d1' => MutasiD1::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiD1 $mutasi_d1): View
    {
        return view('products.show', [
            'mutasi_d1' => $mutasi_d1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiD1 $mutasi_d1): RedirectResponse
    {
        $mutasi_d1->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiD1 $mutasi_d1): RedirectResponse
    {
        $mutasi_d1->truncate();
        return redirect()->route('mutasi_d1.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiD1Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('mutasi_d1')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_d1')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
    }

    public function downloadImportTemplate()
    {
        $path = base_path('/template/mutasi_d.xls');;

        return response()->download($path, 'mutasi_d.xls', [
            'Content-Type' => 'text/xls',
        ]);
    }


    public function cetakBarcode()
    {
        $dataproduk = MutasiD1::all()->groupBy('no_kertas')->toArray(); 
        
        $pdf = PDF::loadView('mutasi_d1.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_d1.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiD1::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_d1.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_d1.pdf');
    }
}
