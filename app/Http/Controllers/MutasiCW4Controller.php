<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiCW4;
use App\Http\Requests\UpdateMutasiCW4Request;
use App\Imports\MutasiCW4Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiCW4Controller extends Controller
{
    /**
     * Instantiate a new MutasiCW4 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-cw4', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_cw4.index', [
            'mutasi_cw4' => MutasiCW4::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiCW4 $mutasi_cw4): View
    {
        return view('products.show', [
            'mutasi_cw4' => $mutasi_cw4
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiCW4 $mutasi_cw4): RedirectResponse
    {
        $mutasi_cw4->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiCW4 $mutasi_cw4): RedirectResponse
    {
        $mutasi_cw4->truncate();
        return redirect()->route('mutasi_cw4.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiCW4Import($indexSheet), $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect('mutasi_cw4')->with('error', 'Error! Terdapat data yang kurang, mohon dicek kembali.');
        } catch (\Exception $e) {
            return redirect('mutasi_cw4')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_cw4')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
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
        $dataproduk = MutasiCW4::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_cw4.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_wt4.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiCW4::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_cw4.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_wtb4.pdf');
    }
}
