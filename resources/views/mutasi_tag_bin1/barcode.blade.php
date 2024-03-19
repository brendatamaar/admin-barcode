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

        table {
            border-spacing: 3px 25px;
        }
    </style>
</head>

<body">

    <div style="display:none">
        @foreach ($dataproduk as $produk)
        {{ $index = $loop->iteration }}
        @endforeach
    </div>

    @if ($index === 1)
    <table width="33%">
        <tr>

            @foreach ($dataproduk as $produk)
            <td class="text-center" style="padding: 10px; border: 4px solid #333; border-spacing: 5px 1rem; border-collapse: separate;">
                <p><b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b></p>
                <p>Area : {{ $produk['zone'] }}</p>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk['tag_bin_location'], 'C39') }}" alt="barcode" width="320" height="45">
                <br>
                <br>
                <br>
                <b>BIN : {{ $produk['tag_bin_location'] }} - {{ $produk['status'] }}</b>
                <br>
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
            <td class="text-center" style="padding: 10px; border: 4px solid #333; border-spacing: 5px 1rem; border-collapse: separate;">
                <p><b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b></p>
                <p>Area : {{ $produk['zone'] }}</p>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk['tag_bin_location'], 'C39') }}" alt="barcode" width="320" height="45">
                <br>
                <br>
                <br>
                <b>BIN : {{ $produk['tag_bin_location'] }} - {{ $produk['status'] }}</b>
                <br>
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
            <td class="text-center" style="padding: 10px; border: 4px solid #333; border-spacing: 5px 1rem; border-collapse: separate;">
                <p><b>{{ $produk['site_id'] }} - {{ $produk['site_name'] }}</b></p>
                <p>Area : {{ $produk['zone'] }}</p>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk['tag_bin_location'], 'C39') }}" alt="barcode" width="320" height="45">
                <br>
                <br>
                <br>
                <b>BIN : {{ $produk['tag_bin_location'] }} - {{ $produk['status'] }}</b>
                <br>
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