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

        .left {
            width: 520px;
            float: left;
            font-size: 16px;
        }

        .right {
            overflow: hidden;
            float: right;
        }

        table,
        th,
        td {
            border: 4px solid black;
            padding: 8px 40px;
            border-collapse: collapse;
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
        {{ $currentIndex = $loop->iteration }}
        @if($loop->last)
        {{ $next_key = $key }}
        @else
        {{ $next_key = get_next_key_array($dataproduk->toArray(), $key) }}
        @endif
    </div>

    @foreach ($produk as $produk_detail)

    @if($loop->first)

    <div class="header" style="margin-top: 20px">
        <table width="100%" style="font-size: 17px;">
            <tr>
                <td rowspan="3" width="65%" style="padding: 8px;">
                    <div style=" text-align: center;">
                        <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk_detail['location'], 'C39') }}" alt="barcode" width="450" height="45">
                        <br><br>
                        <span>
                            BIN ID : {{ $produk_detail['location'] }}
                        </span>
                    </div>
                    <br />
                    <div style="margin: 4px;">
                        <b>Tag Bin Ke : {{ $currentIndex }} / {{count($dataproduk)}}</b>
                        <br />
                        <span>Site : {{ $produk_detail['site_id'] }} - {{ $produk_detail['site_name'] }}</span>
                        <br />
                        <span>Jumlah SKU : {{count($produk)}}</span>
                        <br />
                        <br />

                        <div class="left">
                            <b>Category : {{ $produk_detail['category'] }}</b>
                        </div>
                        <div class="right">
                            <b>Location : {{ $produk_detail['location_type'] }}</b>
                        </div>
                    </div>

                </td>
                <td colspan="3" width="35%" style="text-align: center;">Paraf</td>
            </tr>
            <tr style="text-align: center;">
                <td style="padding: 2px;">Penghitung</td>
                <td style="padding: 2px;">Scanner</td>
                <td style="padding: 2px;">Desk Control</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <table width="100%" style="font-size: 14px;">
        <tr style="text-align: center;">
            <td>BARCODE</td>
            <td>ITEM DESC</td>
            <td>QTY</td>
            <td>Scan Check</td>
        </tr>
        <tr class="text-center">
            <td style="padding: 0px 2px; text-align: center; width: 50%;">
                <p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk_detail['barcode'], 'C39') }}" alt="barcode" width="420" height="45" style="margin-bottom: 10px;">
                    <br />
                    {{ $produk_detail['barcode'] }}
                </p>
            </td>
            <td style="padding: 0px 20px; text-align: center; width: 26%;">{{ $produk_detail['item_no'] }} {{ $produk_detail['item_name'] }} - {{ $produk_detail['uom'] }}</td>
            <td style="width: 12%;"></td>
            <td style="width: 12%;"></td>
        </tr>
    </table>

    @if ($loop->last)
    @if($next_key != $key)
    <div class="page-break"></div>
    @endif
    @endif

    @else
    <table width="100%" style="font-size: 14px;">
        <tr style="text-align: center;">
            <td>BARCODE</td>
            <td>ITEM DESC</td>
            <td>QTY</td>
            <td>Scan Check</td>
        </tr>
        <tr class="text-center">
            <td style="padding: 0px 2px; text-align: center; width: 50%;">
                <p>
                    <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk_detail['barcode'], 'C39') }}" alt="barcode" width="420" height="45" style="margin-bottom: 10px;">
                    <br />
                    {{ $produk_detail['barcode'] }}
                </p>
            </td>
            <td style="padding: 0px 20px; text-align: center; width: 26%;">{{ $produk_detail['item_no'] }} {{ $produk_detail['item_name'] }} - {{ $produk_detail['uom'] }}</td>
            <td style="width: 12%;"></td>
            <td style="width: 12%;"></td>
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