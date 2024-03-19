<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Barcode</title>

    <style>
        .text-center {
            text-align: center;
            font-size: 11px;
        }
    </style>
</head>

<body>
    <table width="100%">
        <tr>

            @foreach ($dataproduk as $produk)
            <td class="text-center" style="border: 1px solid #333;">
                <p><b>{{ $produk['site_id'] }} - JATIMAKMUR - JTM</b></p>
                <p>Area : {{ $produk['zone'] }}</p>
                <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($produk['tag_bin_location'], 'C39') }}" alt="{{ $produk['tag_bin_location'] }}" width="180" height="60">
                <br>
                <br>
                <b>BIN : {{ $produk['tag_bin_location'] }} - {{ $produk['status'] }}</b>
            </td>
            @if ($no++ % 3 == 0)
        </tr>
        <tr>
            @endif
            @endforeach
        </tr>
    </table>
</body>

</html>