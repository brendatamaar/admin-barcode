<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrystalReport4;
use App\Http\Requests\UpdateCrystalReport4Request;
use App\Imports\CrystalReport4Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CrystalReport4Controller extends Controller
{
    /**
     * Instantiate a new CrystalReport4 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view crystal-report4', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('crystal_report4.index', [
            'crystal_report4' => CrystalReport4::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CrystalReport4 $crystal_report4): View
    {
        return view('products.show', [
            'crystal_report4' => $crystal_report4
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CrystalReport4 $crystal_report4): RedirectResponse
    {
        $crystal_report4->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(CrystalReport4 $crystal_report4): RedirectResponse
    {
        $crystal_report4->truncate();
        return redirect()->route('crystal_report4.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new CrystalReport4Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('crystal_report4')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('crystal_report4')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
    }

    public function downloadImportTemplate()
    {
        $path = base_path('/template/crystal_report.xls');;

        return response()->download($path, 'crystal_report.xls', [
            'Content-Type' => 'text/xls',
        ]);
    }


    public function cetakBarcode()
    {
        $dataproduk = CrystalReport4::all()->groupBy('location');

        $pdf = PDF::loadView('crystal_report3.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report3.pdf');
        //return view("crystal_report3.barcode", compact('dataproduk'));
    }

    public function cetakQR()
    {
        $dataproduk = CrystalReport4::all()->groupBy('location');

        $pdf = PDF::loadView('crystal_report3.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report3.pdf');
        //return view("crystal_report1.barcode", compact('dataproduk'));
    }
}
