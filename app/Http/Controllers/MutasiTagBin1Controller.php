<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiTagBin1;
use App\Http\Requests\UpdateMutasiTagBin1Request;
use App\Imports\MutasiTagBin1Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiTagBin1Controller extends Controller
{
    /**
     * Instantiate a new MutasiTagiBin1 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-tag-bin1', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll', 'importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_tag_bin1.index', [
            'mutasi_tag_bin1' => MutasiTagBin1::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiTagBin1 $mutasi_tag_bin1): View
    {
        return view('products.show', [
            'mutasi_tag_bin1' => $mutasi_tag_bin1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiTagBin1 $mutasi_tag_bin1): RedirectResponse
    {
        $mutasi_tag_bin1->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiTagBin1 $mutasi_tag_bin1): RedirectResponse
    {
        $mutasi_tag_bin1->truncate();
        return redirect()->route('mutasi_tag_bin1.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiTagBin1Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('mutasi_tag_bin1')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_tag_bin1')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
    }

    public function downloadImportTemplate()
    {
        $path = base_path('/template/mutasi_tagbin.xls');;

        return response()->download($path, 'mutasi_tagbin.xls', [
            'Content-Type' => 'text/xls',
        ]);
    }


    public function cetakBarcode()
    {
        $dataproduk = MutasiTagBin1::all()->toArray();
        $no  = 1;
        $pdf = PDF::loadView('mutasi_tag_bin1.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_tag_bin1.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiTagBin1::all()->toArray();
        $no  = 1;
        $pdf = PDF::loadView('mutasi_tag_bin1.qr', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_tag_bin1.pdf');
    }
}
