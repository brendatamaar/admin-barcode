@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show mb-2" role="alert">
    {{ session('status') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show mb-2" role="alert">
    {!! session('error') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="excel-csv-import-form" method="POST" action="{{ url('import-excel-crystal-report4') }}" accept-charset="utf-8" enctype="multipart/form-data">
                    @csrf
                    <div class="input-group">
                        <input type="file" id="fileInput" name="file" required />
                        <div id="countSheet" class="form-text text-info"></div>
                    </div>
                    <div class="my-3">
                        <label for="sheet" class="form-label">Masukkan urutan sheet</label>
                        <input type="text" class="form-control" id="sheet" name="sheet" aria-describedby="textHelp">
                        <div id="textHelp" class="form-text text-danger">Pastikan urutan sheet yang akan diimport sesuai dengan sheet yang ada di file Excel.</div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('#excel-csv-import-form')">Import file</button>
            </div>
        </div>
    </div>
</div>

<div class="card">

    <div class="card-header">CR 3</div>
    <div class="card-body">
        <div class="mb-2">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                Import file excel
            </button>
            <br />
            <a class="btn btn-success mt-2" href="{{ url('download-template-crystal-report4') }}" class="text-decoration-none"><i class="fa fa-download"></i>
                Download import template</a>
            <a href="{{ url('delete-all-crystal-report4') }}" class="btn btn-danger mt-2"><i class="fa fa-trash"></i>
                Delete All</a>
            <a href="{{ url('generate-barcode-crystal-report4') }}" target="_blank" class="btn btn-warning btn-xs btn-flat mt-2"><i class="fa fa-print"></i>
                Cetak Barcode</a>
            <a href="{{ url('generate-qr-crystal-report4') }}" target="_blank" class="btn btn-warning btn-xs btn-flat mt-2"><i class="fa fa-print"></i>
                Cetak QR Code</a>

        </div>

        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Site ID</th>
                        <th scope="col">Site Name</th>
                        <th scope="col">Location</th>
                        <th scope="col">Location Type</th>
                        <th scope="col">Category</th>
                        <th scope="col">Item No</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Barcode</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($crystal_report4 as $crystal_report4s)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $crystal_report4s->site_id }}</td>
                        <td>{{ $crystal_report4s->site_name }}</td>
                        <td>{{ $crystal_report4s->location }}</td>
                        <td>{{ $crystal_report4s->location_type }}</td>
                        <td>{{ $crystal_report4s->category }}</td>
                        <td>{{ $crystal_report4s->item_no }}</td>
                        <td>{{ $crystal_report4s->item_name }}</td>
                        <td>{{ $crystal_report4s->barcode }}</td>
                    </tr>
                    @empty
                    <td colspan="9">
                        <span class="text-danger">
                            <strong>Data Kosong</strong>
                        </span>
                    </td>
                    @endforelse
                </tbody>
            </table>
            {{ $crystal_report4->links() }}
        </div>

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.3/xlsx.full.min.js"></script>

<script>
    // Fungsi untuk membaca jumlah sheet dalam file Excel
    function countSheetsInExcel(file) {
        var reader = new FileReader();
        reader.onload = function(e) {
            var data = e.target.result;
            var workbook = XLSX.read(data, {
                type: 'binary'
            });
            var sheetCount = workbook.SheetNames.length;
            $("#countSheet").empty();
            $('#countSheet').append("Jumlah sheet di dalam file Excel: " + sheetCount + " sheet")
        };
        reader.readAsBinaryString(file);
    }

    var input = document.getElementById('fileInput');
    input.addEventListener('change', function(e) {
        var file = e.target.files[0];
        countSheetsInExcel(file);
    });

    function submitForm(input) {
        document.getElementById('excel-csv-import-form').submit();
    }
</script>
@endsection