<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MutasiD4;
use App\Http\Requests\UpdateMutasiD4Request;
use App\Imports\MutasiD4Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class MutasiD4Controller extends Controller
{
    /**
     * Instantiate a new MutasiD4 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view mutasi-d4', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('mutasi_d4.index', [
            'mutasi_d4' => MutasiD4::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MutasiD4 $mutasi_d4): View
    {
        return view('products.show', [
            'mutasi_d4' => $mutasi_d4
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MutasiD4 $mutasi_d4): RedirectResponse
    {
        $mutasi_d4->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(MutasiD4 $mutasi_d4): RedirectResponse
    {
        $mutasi_d4->truncate();
        return redirect()->route('mutasi_d4.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new MutasiD4Import($indexSheet), $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect('mutasi_d4')->with('error', 'Error! Terdapat data yang kurang, mohon dicek kembali.');
        } catch (\Exception $e) {
            return redirect('mutasi_d4')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('mutasi_d4')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
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
        $dataproduk = MutasiD4::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_d4.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('mutasi_d4.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = MutasiD4::all()->groupBy('no_kertas')->toArray();

        $pdf = PDF::loadView('mutasi_d4.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'serif']);
        return $pdf->stream('mutasi_d4.pdf');
    }
}
