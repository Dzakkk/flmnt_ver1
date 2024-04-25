<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-size: 10px;

        font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
    }

    .full-body {
        margin: 5%;
    }

    .header-pemeriksaan {
        margin-bottom: 5px;
    }

    .main-section {
        margin-bottom: 10px;
    }

    img {
        margin-left: 55px;
    }

    .tanggal {
        margin-bottom: 5px;
    }

    .y , .n{
        width: 50px;
    }

    .no {
        align-content: center;
        width: 20px;
    }

    thead {
        background-color: rgb(173, 173, 169)90, 190, 182;
    }

    .ket {
        width: 200px;
    }
    td,
    td {
        border: solid 1px black;
        padding: 1 px;
        text-align: left;
        margin: 0px;
    }

    .container {
        margin-top: 3px;
        background-color: white;
        border: solid 1px black;
        height: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .header,
    .general-info,
    .preparation,
    .product-formula,
    .package,
    .labeling,
    .hMethode {
        margin: 5px;
    }

    .tb td {
        height: 20px;
    }

    .float {
        clear: both;
    }

    .packaging>table td {
        padding: 5px;
    }

    .time td {
        padding: 10px
    }

    .time2 td {
        padding: 10px
    }

    .process {
        width: 65%;
        float: left;
    }

    .process>td,
    td {
        padding: 2px;
    }

    .process>td,
    td {
        padding: 2px;
    }

    .item td {
        padding: 10px;
    }

</style>

<body>
    <div class="full-body">
        <div class="header-pemeriksaan">
            <table>
                <tbody>
                    <tr style="height: 12px">
                        <td rowspan="5" style="width: 20%;"><img src="https://media.licdn.com/dms/image/D560BAQFbx5tbiiF1bw/company-logo_200_200/0/1707282963482/falmont_flavors_logo?e=2147483647&v=beta&t=Lb2kimFauyZ2cc7briKT45MWYPquX4KpyyjbEqtMiBU" alt="logo" width="80rem"></td>
                        <td rowspan="2" style="text-align: center;"><b style="font-size: 18sp">FORM</b></td>
                        <td style="width: 16%;">
                            <p style="font-size: 11sp">Kode Dokumen</p>
                        </td>
                        <td style="width: 16%;">
                            <p style="font-size: 10sp">: FRM - PRD - 00</p>
                        </td>
                    </tr>
                    <tr style="height: 12px">
                        <td>
                            <p style="font-size: 11sp">Level Dokumen</p>
                        </td>
                        <td>
                            <p style="font-size: 10sp">: IV</p>
                        </td>
                    </tr>
                    <tr style="height: 12px">
                        <td rowspan="3" style="text-align: center;"><b style="font-size: 18sp">PEMERIKSAAN PENGIRIMAN PRODUK</b>
                        </td>
                        <td>
                            <p style="font-size: 11sp">Revisi</p>
                        </td>
                        <td>
                            <p style="font-size: 10sp">: 1</p>
                        </td>
                    </tr>
                    <tr style="height: 12px">
                        <td>
                            <p style="font-size: 11sp">Tanggal Efektif</p>
                        </td>
                        <td>
                            <p style="font-size: 10sp">: 2 Desember 2023</p>
                        </td>
                    </tr>
                    <tr style="height: 12px">
                        <td>
                            <p style="font-size: 11sp">Kadaluarsa</p>
                        </td>
                        <td>
                            <p style="font-size: 10sp">: 4 Desember 2023</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="tanggal">Tanggal Pengiriman : {{ $tanggal }}</div>
        <div class="main-section">
            <table class="tb">
                <thead>
                    <td class="no">No</td>
                    <td>No. Surat Jalan</td>
                    <td>Customer</td>
                    <td>Kode Produk</td>
                    <td>Nama Barang</td>
                    <td>No. LOT</td>
                    <td>Jumlah</td>
                    <td>Unit</td>
                    <td>Shipment</td>
                    <td>Rak Simpan</td>
                    <td>Tanggal Expired</td>
                </thead>
                <tbody>
                    @foreach ($filteredData as $i)
                        <tr>
                            <td>1</td>
                            <td>{{ $i->NoSuratJalankeluar_NoProduksi }}</td>
                            <td>{{ \App\Models\Customer::find($i->id_customer)->customer_name ?? null}}</td>
                            <td>{{ $i->FAI_code }}</td>
                            <td>{{ \App\Models\Barang::find($i->FAI_code)->name ?? null}}</td>
                            <td>{{ $i->no_LOT }}</td>
                            <td>{{ $i->total_qty_keluar_LOT }}</td>
                            <td>{{ $i->unit }}</td>
                            <td>{{ $i->shipment }}</td>
                            <td>{{ $i->id_rak }}</td>
                            <td>{{ $i->tanggal_expire }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="parameter-section">
            <table class="tb">
                <thead>
                    <td rowspan="2" class="no">No</td>
                    <td rowspan="2">Parameter Pemeriksaan</td>
                    <td colspan="2">Checker</td>
                    <td rowspan="2" class="ket">Keterangan</td>
                </thead>
                <tr>
                    <td class="y">Ya</td>
                    <td class="n">Tidak</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Apakah kondisi kendaraan dalam keadaan bersih? (tidak tercemar minyak, oli atau cairan lain yang dapat menyebabkan kerusakan barang yang ada didalam)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Apakah ada aroma menyimpang dari dalam kendaraan selain dari aroma bahan baku/barang yang diterima?</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Apakah kondisi box penutup dalam keadaan baik dan tidak terdapat bocor/celah?</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Apakah tidak ditemukan adanya cemaran hama/kotoran /najis/ dan benda asing lainnya?</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Apakah barang tidak tercampur dengan barang yang tidak halal?</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Apakah barang tersusun dalam keadaan rapi?</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Apakah label identitas produk sudah sesuai dengan surat jalan? (Nama, Kode, Lot, Exp Date)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Apakah dokumen CoA sudah sesuai dengan label identitas pada setiap produk yang diterima? (Nama, Kode, Lot, Exp Date)</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2"><b>Paraf dan Nama Jelas</b></td>
                    <td colspan="3"></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
