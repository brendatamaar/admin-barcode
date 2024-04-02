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
            padding: 1px 40px;
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
        @if($loop->last)
        {{ $next_key = $key }}
        @else
        {{ $next_key = get_next_key_array($dataproduk->toArray(), $key) }}
        @endif
    </div>

    @foreach ($produk as $produk_detail)

    @if($loop->first)

    <div class="header" style="margin-bottom: 10px;">
        <table width="100%" style="font-size: 17px;">
            <tr>
                <td rowspan="3" width="65%" style="padding-top: 2px; padding-bottom: 8px; padding-left: 8px; padding-right: 8px;">
                    <div style=" text-align: center;">
                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk_detail['location'], 'QRCODE') }}" alt="barcode" width="75" height="75" style="margin-bottom: 5px;">
                        <br />
                        <span>
                            BIN ID : {{ $produk_detail['location'] }}
                        </span>
                    </div>
                    <br />
                    <div style="margin: 4px;">
                        <b>Tag Bin Ke : {{ $produk_detail['location'] }} / {{ $next_key }}</b>
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
                <td style="padding: 1px;">Penghitung</td>
                <td style="padding: 1px;">Scanner</td>
                <td style="padding: 1px;">Desk Control</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>

    <table width="100%" style="font-size: 14px; margin-bottom:10px">
        <tr style="text-align: center; font-weight: bold;">
            <td>BARCODE</td>
            <td>ITEM DESC</td>
            <td style="padding: 1px">QTY</td>
            <td>Scan Check</td>
        </tr>
        <tr class="text-center">
            <td style="padding: 10px 2px; text-align: center; width: 30%;">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk_detail['barcode'], 'QRCODE') }}" alt="barcode" width="75" height="75" style="margin-bottom: 10px;">
                <br />
                {{ $produk_detail['barcode'] }}
            </td>
            <td style="padding: 0px 20px; text-align: center; width: 45%;">{{ $produk_detail['item_no'] }} {{ $produk_detail['item_name'] }} - {{ $produk_detail['uom'] }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    @if ($loop->last)
    @if($next_key != $key)
    <div class="page-break"></div>
    @endif
    @endif

    @else
    <table width="100%" style="font-size: 14px; margin-bottom:10px">
        <tr style="text-align: center; font-weight: bold;">
            <td>BARCODE</td>
            <td>ITEM DESC</td>
            <td style="padding: 1px">QTY</td>
            <td>Scan Check</td>
        </tr>
        <tr class="text-center">
            <td style="padding: 10px 2px; text-align: center; width: 30%;">
                <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk_detail['barcode'], 'QRCODE') }}" alt="barcode" width="75" height="75" style="margin-bottom: 10px;">
                <br />
                {{ $produk_detail['barcode'] }}
            </td>
            <td style="padding: 0px 20px; text-align: center; width: 45%;">{{ $produk_detail['item_no'] }} {{ $produk_detail['item_name'] }} - {{ $produk_detail['uom'] }}</td>
            <td></td>
            <td></td>
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
        $h = $pdf->get_height();
        $size = 6;
        $font_bold = $fontMetrics->getFont("helvetica", "bold");
        $text_height = $fontMetrics->getFontHeight($font_bold, $size);
        $y = $h - $text_height - 24;

        // generated text written to every page after rendering
        $pdf->page_text(540, $y, "Page {PAGE_NUM} of {PAGE_COUNT}", $font_bold, $size, [0, 0, 0]);
    }
    </script>
</body>

</html>