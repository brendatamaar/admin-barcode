<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrystalReport1;
use App\Http\Requests\UpdateCrystalReport1Request;
use App\Imports\CrystalReport1Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CrystalReport1Controller extends Controller
{
    /**
     * Instantiate a new CrystalReport1 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view crystal-report1', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('crystal_report1.index', [
            'crystal_report1' => CrystalReport1::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CrystalReport1 $crystal_report1): View
    {
        return view('products.show', [
            'crystal_report1' => $crystal_report1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CrystalReport1 $crystal_report1): RedirectResponse
    {
        $crystal_report1->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(CrystalReport1 $crystal_report1): RedirectResponse
    {
        $crystal_report1->truncate();
        return redirect()->route('crystal_report1.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }
    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new CrystalReport1Import($indexSheet), $request->file('file'));
        } catch (\Exception $e) {
            return redirect('crystal_report1')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('crystal_report1')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
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
        $dataproduk = CrystalReport1::all()->unique('item_no')->unique('item_name')->groupBy('location'); 
        
        $pdf = PDF::loadView('crystal_report1.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report1.pdf');
    }

    public function cetakQR()
    {
        $dataproduk = CrystalReport1::all()->unique('item_no')->unique('item_name')->groupBy('location'); 
        
        $pdf = PDF::loadView('crystal_report1.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report1.pdf');
    }
}
