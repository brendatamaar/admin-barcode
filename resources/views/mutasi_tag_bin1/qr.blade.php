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

        .text-center {
            text-align: center;
            font-size: 16px;
        }

        div.right-align {
            width: 70%;
            float: right;
            text-align: left;
            background: transparent;
            margin: 10px 0 10px 0;
        }

        div.full-align {
            width: 100%;
            text-align: center;
        }

        div.left-align {
            width: 25%;
            float: left;
            text-align: right;
            background: transparent;
            margin: 30px 0;
        }

        div.center-align {
            width: 1%;
            margin: 0 auto;
            background: transparent;
            clear: both;
        }

        .table {
            border-spacing: 3px 25px;
        }
    </style>
</head>

<body>

    <div style="display:none">
        @foreach ($dataproduk as $produk)
        {{ $index = $loop->iteration }}
        @endforeach
    </div>

    @if ($index === 1)
    <table width="33%">
        <tr>

            @foreach ($dataproduk as $produk)
            <td class="text-center" style="border: 4px solid #333; font-weight: bold;">
                <table width="100%" style="margin: auto;" style="border: 1px solid #333;">
                    <tr style="border: 1px solid #333;">
                        <td colspan="3" style="text-align: center; border: 1px solid #333;"><b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b>
                        </td>
                    </tr>
                    <tr style="border: 1px solid #333;">
                        <td style="border: 1px solid #333; padding: 8px; text-align: center;" rowspan="3" width="40%"><img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk['tag_bin_location'], 'QRCODE') }}" alt="barcode" width="85" height="85"></td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;" width="20%">Zone</td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;">:{{ $produk['zone'] }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #333; text-align: left;  padding-left: 10px;" width="20%">Bin</td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;">:{{ $produk['tag_bin_location'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #333; text-align: center;">{{ $produk['status'] }}</td>
                    </tr>
                </table>
            </td>
            @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
    @elseif ($index === 2)
    <table width="66%">
        <tr>

            @foreach ($dataproduk as $produk)
            <td class="text-center" style="border: 4px solid #333; font-weight: bold;">
                <table width="100%" style="margin: auto;" style="border: 1px solid #333;">
                    <tr style="border: 1px solid #333;">
                        <td colspan="3" style="text-align: center; border: 1px solid #333;"><b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b>
                        </td>
                    </tr>
                    <tr style="border: 1px solid #333;">
                        <td style="border: 1px solid #333; padding: 8px; text-align: center;" rowspan="3" width="40%"><img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk['tag_bin_location'], 'QRCODE') }}" alt="barcode" width="85" height="85"></td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;" width="20%">Zone</td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;">:{{ $produk['zone'] }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #333; text-align: left;  padding-left: 10px;" width="20%">Bin</td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;">:{{ $produk['tag_bin_location'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #333; text-align: center;">{{ $produk['status'] }}</td>
                    </tr>
                </table>
            </td>
            @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
    @else
    <table width="100%" class="table">
        <tr>

            @foreach ($dataproduk as $produk)
            <td class="text-center" style="border: 4px solid #333; font-weight: bold;">
                <table width="100%" style="margin: auto;" style="border: 1px solid #333;">
                    <tr style="border: 1px solid #333;">
                        <td colspan="3" style="text-align: center; border: 1px solid #333;"><b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b>
                        </td>
                    </tr>
                    <tr style="border: 1px solid #333;">
                        <td style="border: 1px solid #333; padding: 8px; text-align: center;" rowspan="3" width="40%"><img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk['tag_bin_location'], 'QRCODE') }}" alt="barcode" width="85" height="85"></td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;" width="20%">Zone</td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;">:{{ $produk['zone'] }}</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #333; text-align: left;  padding-left: 10px;" width="20%">Bin</td>
                        <td style="border: 1px solid #333; text-align: left; padding-left: 10px;">:{{ $produk['tag_bin_location'] }}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="border: 1px solid #333; text-align: center;">{{ $produk['status'] }}</td>
                    </tr>
                </table>
            </td>
            @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
    @endif

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