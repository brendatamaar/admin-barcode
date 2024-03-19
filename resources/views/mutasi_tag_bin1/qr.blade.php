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
            font-size: 17px;
        }

        div.right-align {
            width: 70%;
            float: right;
            text-align: left;
            background: transparent;
            margin: 10px 0 10px 0;
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

        table {
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
            <td class="text-center" style="border: 4px solid #333;">

                <div class="left-align">
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk['tag_bin_location'], 'QRCODE') }}" alt="barcode" width="85" height="85">
                </div>

                <div class="right-align">
                    <b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b>
                    <br />
                    <br />
                    <b>Area : {{ $produk['zone'] }}</b>
                    <br />
                    <br />
                    <b>BIN : {{ $produk['tag_bin_location'] }}</b>
                    <br /> <b>{{ $produk['status'] }}</b>

                </div>

                <div class="center-align medium-font dotted-border bg-dkred">

                </div>
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
            <td class="text-center" style="border: 4px solid #333;">

                <div class="left-align">
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk['tag_bin_location'], 'QRCODE') }}" alt="barcode" width="85" height="85">
                </div>

                <div class="right-align">
                    <b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b>
                    <br />
                    <br />
                    <b>Area : {{ $produk['zone'] }}</b>
                    <br />
                    <br />
                    <b>BIN : {{ $produk['tag_bin_location'] }}</b>
                    <br /> <b>{{ $produk['status'] }}</b>

                </div>

                <div class="center-align medium-font dotted-border bg-dkred">

                </div>
            </td>
            @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
    @else
    <table width="100%">
        <tr>

            @foreach ($dataproduk as $produk)
            <td class="text-center" style="border: 4px solid #333;">

                <div class="left-align">
                    <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($produk['tag_bin_location'], 'QRCODE') }}" alt="barcode" width="85" height="85">
                </div>

                <div class="right-align">
                    <b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b>
                    <br />
                    <br />
                    <b>Area : {{ $produk['zone'] }}</b>
                    <br />
                    <br />
                    <b>BIN : {{ $produk['tag_bin_location'] }}</b>
                    <br /> <b>{{ $produk['status'] }}</b>

                </div>

                <div class="center-align medium-font dotted-border bg-dkred">

                </div>
            </td>
            @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
    @endif


</body>

</html>