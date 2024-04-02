<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiCW3;
use App\Http\Requests\UpdateMutasiCW3Request;
use App\Imports\MutasiCW3Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiCW3Controller extends Controller
{
    /**
     * Instantiate a new MutasiCW3 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-cw3', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_cw3.index', [
            'mutasi_cw3' => MutasiCW3::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiCW3 $mutasi_cw3): View
    {
        return view('products.show', [
            'mutasi_cw3' => $mutasi_cw3
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiCW3 $mutasi_cw3): RedirectResponse
    {
        $mutasi_cw3->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiCW3 $mutasi_cw3): RedirectResponse
    {
        $mutasi_cw3->truncate();
        return redirect()->route('mutasi_cw3.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiCW3Import($indexSheet), $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect('mutasi_cw3')->with('error', 'Error! Terdapat data yang kurang, mohon dicek kembali.');
        } catch (\Exception $e) {
            return redirect('mutasi_cw3')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_cw3')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
    }

    public function downloadImportTemplate()
    {
        $path = base_path('/template/mutasi_wtb.xls');;

        return response()->download($path, 'mutasi_wtb.xls', [
            'Content-Type' => 'text/xls',
        ]);
    }


    public function cetakBarcode()
    {
        $dataproduk = MutasiCW3::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_cw3.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_wtb3.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiCW3::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_cw3.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_wtb3.pdf');
    }
    
}
