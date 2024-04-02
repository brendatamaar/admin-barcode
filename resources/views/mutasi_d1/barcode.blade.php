<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        html {
            margin: 10px;
        }

        .header {
            margin: 20px 0 0 45px;
        }

        .left {
            width: 540px;
            float: left;
            font-size: 20px;
        }

        .right {
            overflow: hidden;
            float: right;
        }

        table,
        th,
        td {
            text-align: center;
            border: 4px solid black;
            padding: 8px 40px;
            border-collapse: collapse;
        }

        table {
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
            font-size: 14px;
        }

        .text-table {
            font-size: 16px;
        }

        .page-break {
            page-break-after: always;
        }

        .not-page-break {
            page-break-after: avoid;
        }
    </style>
</head>

<body>

    @foreach ($dataproduk as $key => $produk)

    <div style="display: none;">
        @if($loop->last)
        {{ $next_key = $key }}
        {{ $lastKey = $key }}
        @else
        {{ $next_key = get_next_key_array($dataproduk, $key) }}
        {{ $lastKey = key(array_slice($dataproduk, -1, 1, true));}}
        @endif
    </div>
    @foreach ($produk as $produk_detail)

    @if($loop->first)
    <div class="header">
        <div class="left">
            <b>KERTAS KERJA TAG BIN</b>
            <br />
            SITE: {{ $produk_detail['site_id'] }} - {{ $produk_detail['site_name'] }}
            <br />
            Area: {{ $produk_detail['area'] }} / Zone: {{ $produk_detail['zone'] }}
            <br /><i>Jumlah Tag Bin: {{count($produk)}}</i>
            <br /><i>Jumlah Kertas Kerja: {{ $produk_detail['no_kertas'] }} / {{ $lastKey }}</i>
        </div>
        <div class="right">
            <table class="text-center">
                <tr>
                    <td colspan="2">Penghitung</td>
                    <td colspan="2">Scanner</td>
                    <td>Desk Control</td>
                </tr>
                <tr>
                    <td>P1</td>
                    <td>P2</td>
                    <td>P1</td>
                    <td>P2</td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                        <div style="height: 60px"></div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </div>

    </div>
    <br /><br /><br /><br /><br /><br />
    <table width="100%">
        <tr style="font-size: 14px;">
            <td style="padding: 10px;">Bin Ke</td>
            <td style="padding: 10px;">Tag Bin Location</td>
            <td>BARCODE BIN ID</td>
            <td style="padding: 10px;">SKU PHASE 1</td>
            <td style="padding: 10px;">SKU PHASE 2</td>
        </tr>
        <tr class="text-table">
            <td width="5%" style="padding: 10px;">{{ $loop->index + 1 }} / {{count($produk)}}</td>
            <td width="10%">{{ $produk_detail['tag_bin_location'] }}</td>
            <td width="40%"><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk_detail['tag_bin_location'], 'C39') }}" alt="barcode" width="420" height="40"></td>
            <td width="15%"></td>
            <td width="15%"></td>
        </tr>
    </table>

    @if ($loop->last)
    @if($next_key != $key)
    <div class="page-break"></div>
    @endif
    @endif

    @else

    <table width="100%">
        <tr style="font-size: 14px;">
            <td style="padding: 10px;">Bin Ke</td>
            <td style="padding: 10px;">Tag Bin Location</td>
            <td>BARCODE BIN ID</td>
            <td style="padding: 10px;">SKU PHASE 1</td>
            <td style="padding: 10px;">SKU PHASE 2</td>
        </tr>
        <tr class="text-table">
            <td width="5%" style="padding: 10px;">{{ $loop->index + 1 }} / {{count($produk)}}</td>
            <td width="10%">{{ $produk_detail['tag_bin_location'] }}</td>
            <td width="40%"><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk_detail['tag_bin_location'], 'C39') }}" alt="barcode" width="420" height="40"></td>
            <td width="15%"></td>
            <td width="15%"></td>
        </tr>
    </table>

    @if(($loop->index + 1) % 8 == 0)
    @if($loop->last)
    <div class="not=page-break"></div>
    @else
    <div class="page-break"></div>
    @endif
    @endif

    @if($loop->last)
    @if($next_key != $key)
    <div class="page-break"></div>
    @endif
    @endif


    @endif
    @endforeach


    @endforeach

    <script type="text/php">
    if ( isset($pdf) ) {
        $size = 6;
        $font_bold = $fontMetrics->getFont("helvetica", "bold");
        
        // generated text written to every page after rendering
        $pdf->page_text(540, 5, "Page {PAGE_NUM} of {PAGE_COUNT}", $font_bold, $size, [0, 0, 0]);
    }
    </script>
</body>

</html>