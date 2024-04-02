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
        border: solid 2px black;
    }

    .ttd {
        height: 40px;
        width: 85px;
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

    .tgl {
        margin-bottom: 5px;
        padding: 8px;
        border: solid 1px black;
        display: flex;
    }

    .y , .n{
        width: 50px;
    }

    .tb-1 {
        margin-left: 799px;
        padding: 15px;
        width: 200px;
    }

    .tb {
        padding: 15px;
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
                        <td rowspan="4" style="width: 20%;"><img src="https://media.licdn.com/dms/image/D560BAQFbx5tbiiF1bw/company-logo_200_200/0/1707282963482/falmont_flavors_logo?e=2147483647&v=beta&t=Lb2kimFauyZ2cc7briKT45MWYPquX4KpyyjbEqtMiBU" alt="logo" width="80rem"></td>
                        <td rowspan="2" style="text-align: center;"><b><h3>FORM</h3></b></td>
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
                        <td rowspan="2" style="text-align: center;"><b><h3>PERMINTAAN BARANG</h3></b>
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
                </tbody>
            </table>
            <div class="tgl">
                <div>Tanggal : {{ $tanggal }}</div>
                {{-- <div>Asal Departemen : {{ $departemen }}</div>  --}}
                <div>Nomor : </div> 
            </div>
        </div>
        <div class="main-section">
            <table class="tb">
                <thead>
                    <td class="no">No</td>
                    <td>nama</td>
                    <td>Kode</td>
                    <td>LOT</td>
                    <td>Jumlah</td>
                    <td>Keterangan</td>
                    <td>Status</td>
                    <td>Request</td>
                </thead>
                <tbody>
                    @foreach ($filteredData as $i)
                        <tr>
                            <td>1</td>
                            <td>{{ $i->nama }}</td>
                            <td>{{ $i->kode }}</td>
                            <td>{{ $i->LOT }}</td>
                            <td>{{ $i->quantity }}</td>
                            <td>{{ $i->keterangan }}</td>
                            <td>{{ $i->status }}</td>
                            <td>{{ $i->request_by }} - {{ $i->departemen }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div>
            <table class="tb-1">
                <tr>
                    <td>Dibuat Oleh</td>
                    <td>Diterima Oleh</td>
                </tr>
                <tr>
                    <td class="ttd"></td>
                    <td class="ttd"></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
