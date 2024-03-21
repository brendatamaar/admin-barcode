<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrystalReport2;
use App\Http\Requests\UpdateCrystalReport2Request;
use App\Imports\CrystalReport2Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CrystalReport2Controller extends Controller
{
    /**
     * Instantiate a new CrystalReport2 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view crystal-report2', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('crystal_report2.index', [
            'crystal_report2' => CrystalReport2::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CrystalReport2 $crystal_report2): View
    {
        return view('products.show', [
            'crystal_report2' => $crystal_report2
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CrystalReport2 $crystal_report2): RedirectResponse
    {
        $crystal_report2->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(CrystalReport2 $crystal_report2): RedirectResponse
    {
        $crystal_report2->truncate();
        return redirect()->route('crystal_report2.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new CrystalReport2Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('crystal_report2')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('crystal_report2')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
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
        $dataproduk = CrystalReport2::all()->unique('item_no')->unique('item_name')->groupBy('location'); 
        
        $pdf = PDF::loadView('crystal_report2.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report2.pdf');
        //return view("crystal_report2.barcode", compact('dataproduk'));
    }

    public function cetakQR()
    {
        $dataproduk = CrystalReport2::all()->unique('item_no')->unique('item_name')->groupBy('location'); 
        
        $pdf = PDF::loadView('crystal_report2.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report2.pdf');
        //return view("crystal_report1.barcode", compact('dataproduk'));
    }
}
