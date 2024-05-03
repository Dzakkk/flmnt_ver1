<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Jenis Penerimaan</th>
                <th>Tanggal Masuk</th>
                <th>Supplier</th>
                <th>No Surat Jalan / No Produksi</th>
                <th>No PO/WO</th>
                <th>Kategori</th>
                <th>Dokumen</th>
                <th>FAI Code</th>
                <th>Campur</th>
                <th>LOT</th>
                <th>Tanggal Produksi</th>
                <th>Tanggal Expire</th>
                <th>Total QTY</th>
                <th>Unit</th>
                <th>Jenis Kemasan</th>
                <th>Satauan/kemasan</th>
                <th>Total Kemasan</th>
                <th>Status</th>
                <th>Note</th>
                <th>RAK</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brg as $p)
                <tr>
                    <td>{{ $p->jenis_penerimaan }}</td>
                    <td>{{ $p->tanggal_masuk }}</td>
                    <td>{{ $p->id_supplier }}</td>
                    <td>{{ $p->NoSuratJalanMasuk_NoProduksi }}</td>
                    <td>{{ $p->NoPO_NoWO }}</td>
                    <td>{{ $p->kategori_barang }}</td>
                    <td>{{ $p->dokumen }}</td>
                    <td>{{ $p->FAI_code }}</td>
                    <td>
                        @if ($p->FAI_code == $p->barang->FAI_code)
                            {{ $p->barang->name }} {{ $p->barang->common_name }} {{ $p->barang->initial_ex }}
                        @elseif ($p->FAI_code == $p->product->FAI_code)
                            {{ $p->product_name }}
                        @elseif ($p->FAI_code == $p->package->FAI_code)
                            {{ $p->package->nama_kemasan }} {{ $p->package->manufacturer }}
                        @else
                        no
                        @endif
                    </td>
                    <td>{{ $p->no_LOT }}</td>
                    <td>{{ $p->tanggal_produksi }}</td>
                    <td>{{ $p->tanggal_expire }}</td>
                    <td>{{ $p->qty_masuk_LOT }}</td>
                    <td>{{ $p->unit }}</td>
                    <td>{{ $p->jenis_kemasan }}</td>
                    <td>{{ $p->satuan_QTY_kemasan }}</td>
                    <td>{{ $p->total_QTY_kemasan }}</td>
                    <td>{{ $p->status }}</td>
                    <td>{{ $p->note }}</td>
                    <td>{{ $p->id_rak }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
