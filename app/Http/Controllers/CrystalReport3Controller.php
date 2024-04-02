<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrystalReport3;
use App\Http\Requests\UpdateCrystalReport3Request;
use App\Imports\CrystalReport3Import;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CrystalReport3Controller extends Controller
{
    /**
     * Instantiate a new CrystalReport3 instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view crystal-report3', ['only' => ['index', 'show', 'cetakBarcode', 'deleteAll','importExcel', 'cetakBarcode']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('crystal_report3.index', [
            'crystal_report3' => CrystalReport3::latest()->paginate(10)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CrystalReport3 $crystal_report3): View
    {
        return view('products.show', [
            'crystal_report3' => $crystal_report3
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CrystalReport3 $crystal_report3): RedirectResponse
    {
        $crystal_report3->delete();
        return redirect()->route('products.index')
            ->withSuccess('Product is deleted successfully.');
    }

    /**
     * Remove all data.
     */
    public function deleteAll(CrystalReport3 $crystal_report3): RedirectResponse
    {
        $crystal_report3->truncate();
        return redirect()->route('crystal_report3.index')
            ->with('error', 'Semua data berhasil dihapus.');
    }

    public function importExcel(Request $request)
    {
        $indexSheet = $request->input('sheet');
        try {
            Excel::import(new CrystalReport3Import($indexSheet), $request->file('file'));
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect('crystal_report3')->with('error', 'Error! Terdapat data yang kurang, mohon dicek kembali.');
        } catch (\Exception $e) {
            return redirect('crystal_report3')->with('error', 'Error! Pastikan sheet dan template excel sudah sesuai. ');
        }

        return redirect('crystal_report3')->with('status', 'Import excel di sheet ' . $indexSheet . ' berhasil');
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
        $dataproduk = CrystalReport3::all()->groupBy('location')->map(function ($items) {
            return $items->unique('item_no')->unique('item_name');
                })->values();
        
        $pdf = PDF::loadView('crystal_report3.barcode', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report3.pdf');
        //return view("crystal_report3.barcode", compact('dataproduk'));
    }

    public function cetakQR()
    {
        $dataproduk = CrystalReport3::all()->groupBy('location')->map(function ($items) {
            return $items->unique('item_no')->unique('item_name');
                })->values();
        
        $pdf = PDF::loadView('crystal_report3.qr', compact('dataproduk'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOption(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        return $pdf->stream('crystal_report3.pdf');
        //return view("crystal_report1.barcode", compact('dataproduk'));
    }
}
