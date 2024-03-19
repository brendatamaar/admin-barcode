<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        html {
            margin: 20px 40px;
        }

        .left {
            width: 600px;
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
            border: 2px solid black;
            border-collapse: collapse;
            text-align: center;
        }

        .tables {
            padding: 8px 40px;
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
        {{ $next_key = get_next_key_array($dataproduk->toArray(), $key) }}
        {{ $lastKey = key(array_slice($dataproduk->toArray(), -1, 1, true));}}
        @endif
    </div>

    <div class="header">
        <div class="left">
            <b>KERTAS KERJA PHASE-3</b>
            <br />
            <b>STOCK TAKE GLOBAL - {{ $produk[0]['site_name'] }} </b>
            <br />
            <b>29 FEBRUARI - 01 MARET 2024</b>
            <br /><br /><br /><br /><br /><br />
            <b>DIVISI / LOKASI : {{ $key }}</b>
        </div>
        <div class="right">
            <table>
                <tr class="tables">
                    <td class="tables">Checked by</td>
                    <td class="tables">Scanner</td>
                    <td class="tables">STORE MANAGER</td>
                </tr>
                <tr class="tables">
                    <td height="55"></td>
                    <td height="55"></td>
                    <td height="55"></td>
                </tr>
                <tr>
                    <td height="15"></td>
                    <td height="15"></td>
                    <td height="15"></td>
                </tr>
            </table>
        </div>

    </div>

    <br /><br /><br /><br /><br /><br /><br /><br />
    <table width="100%" style="font-size: 18px;">
        <tr style="background-color: yellow;">
            <td width="3%" style="padding-top: 10px; padding-bottom: 10px;">No</td>
            <td width="22%">Scan Id BIN</td>
            <td width="8%">BIN ID</td>
            <td width="8%">Bin Name</td>
            <td width="22%">Scan Barcode</td>
            <td width="8%">Barcode</td>
            <td width="8%">Item No</td>
            <td width="10%">Item Name</td>
            <td width="5%">Final Qty</td>
        </tr>
    </table>
    @foreach ($produk as $produk_detail)
    <table width="100%" style="font-size: 18px;">
        <tr>
            <td width="3%">{{ $no++ }}</td>
            <td width="22%" style="padding-top: 25px; padding-bottom: 25px;"><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk_detail['location'], 'C39') }}" alt="barcode" width="320" height="45">
            </td>
            <td width="8%">{{ $produk_detail['location'] }}</td>
            <td width="8%">{{ $produk_detail['category'] }}</td>
            <td width="22%"><img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk_detail['barcode'], 'C39') }}" alt="barcode" width="320" height="45"></td>
            <td width="8%">{{ $produk_detail['barcode'] }}</td>
            <td width="8%">{{ $produk_detail['item_no'] }}</td>
            <td width="10%">{{ $produk_detail['item_name'] }}</td>
            <td width="5%"></td>
        </tr>

    </table>
    
    @if($loop->index < 9)
        @if ($loop->index === 7)
            @if($loop->last)
            <div class="not=page-break"></div>
            @else
            <div class="page-break"></div>
            @endif
        @endif

    @else

        @if (($loop->index - 7) % 12 === 0)
            @if($loop->last)
            <div class="not=page-break"></div>
            @else
            <div class="page-break"></div>
            @endif
        @endif
    @endif

    @if($loop->last)
    @if($next_key != $key)
    <div class="page-break"></div>
    @endif
    @endif

    @endforeach


    @endforeach



</body>

</html>