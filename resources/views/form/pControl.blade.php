<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>pdf</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        font-size: 10px;

        font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
    }

    td,
    td {
        border: solid 1px black;
        padding: 1 px;
        text-align: left;
        margin: 0px;
    }

    input[type=text] {
        background: transparent;
        border: none;
        border-bottom: solid 1px black;
        width: 200px;
        margin-left: 100px;
    }

    .methode {
        display: flex;
    }


    .container {
        margin-top: 3px;
        background-color: white;
        border: solid 1px black;
        height: auto;
    }

    label {
        font-weight: bold;
        margin-right: 10px;
        margin-left: 5px
    }

    .quantity {
        display: flex;
    }

    .packaging {}

    .package2 {
        display: flex;
    }

    .gen>div {
        margin: 3px;
        align-items: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    .pre {
        display: flex;
    }

    .pre>div {
        margin-right: 30px;
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

    .methode>.wheiging {
        margin-left: 0px;
    }

    .general-info {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .gen {
        border: solid 1px black;
        float: left;
        width: 49%;
        padding-bottom: 5px;
        padding-left: 5px;

    }

    .quantity>table {
        margin-left: 20px;
    }

    .float {
        clear: both;
    }

    .packaging>table td {
        padding: 5px;
    }

    .body1 {
        margin: 10px;
    }

    .tank {
        width: 200px;
        float: left;
    }

    .time {
        width: 150px;
        float: right;

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

    .wheiging {
        width: 30%;
        float: right;
    }

    .kiri {
        width: 30%;
        float: left;
    }

    .qty {
        width: 80px;
        float: left;
    }

    .time2 {
        width: 190px;
        float: left;
    }

    .item {
        width: 130px;
        margin-left: 210px;
    }

    .item td {
        padding: 10px;
    }

    .packaging {
        display: flex;
    }

    .quantity {
        margin-left: 360px;
    }

    .labeling {
        width: 98%;
    }
</style>

<body>
    <div class="body1">

        <div>
            <table>
                <tbody>
                    <tr style="height: 12px">
                        <td rowspan="5" style="width: 20%;"><img src="" alt="logo" width="150rem"></td>
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
                        <td rowspan="3" style="text-align: center;"><b style="font-size: 18sp">PRODUCTION CONTROL</b>
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

        <div class="container">
            <div class="general-info">
                <div class="general">
                    <div class="gen">
                        <div>
                            <p style="float: left">No.&nbsp;Production</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $no_production }}">
                        </div>
                        <div>
                            <p style="float: left">Production&nbsp;Date</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $tanggal_produksi }}">
                        </div>
                        <div>
                            <p style="float: left">No.&nbsp;Work&nbsp;Order</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $no_work_order }}">
                        </div>
                        <div>
                            <p style="float: left">Product&nbsp;Name</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $product_name }}">
                        </div>
                        <div>
                            <p style="float: left">Qty&nbsp;Production</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $quantity }}&nbsp;KG">
                        </div>
                    </div>
                    <div class="gen">
                        <div>
                            <p style="float: left">Lot&nbsp;Number</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $no_LOT }}">
                        </div>
                        <div>
                            <p style="float: left">Local&nbsp;Code</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $FAI_code }}">
                        </div>
                        <div>
                            <p style="float: left">Customer&nbsp;Name</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $customer_name }}">
                        </div>
                        <div>
                            <p style="float: left">Customer&nbsp;Code</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $customer_code }}">
                        </div>
                        <div>
                            <p style="float: left">Po.&nbsp;Customer</p>
                            <input type="text" value=":&nbsp;&nbsp;{{ $PO_customer }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="float"></div>
            <div class="preparation">
                <b>PREPARATION</b>
                <div class="pre">
                    <div>
                        <table class="tank">
                            <h5>TANK</h5>
                            <tbody>
                                <tr>
                                    <td>CLEANLESS</td>
                                    <td>YES</td>
                                    <td>NO</td>
                                </tr>
                                <tr>
                                    <td>ODDORLESS</td>
                                    <td>YES</td>
                                    <td>NO</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="time">
                        <h5>TIME</h5>
                        <table>
                            <tbody>
                                <tr>
                                    <td>START</td>
                                    <td>FINISHED</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="float"></div>
            <div class="product-formula">
                <b>PRODUCT FORMULA</b>
                <table>
                    <thead>
                        <tr>
                            <td>NO</td>
                            <td>RAW MATERIAL</td>
                            <td>QTY</td>
                            <td>LOT NUMBER</td>
                            <td>EXPIRE DATE</td>
                            <td>SUPPLIER</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataArray as $index => $barang_data)
                            <tr>
                                <td></td>
                                <td>{{ $barang_data }}</td>
                                <td>{{ $persentase_array[$index] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="2">TOTAL</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="hMethode">
                <div class="methode">
                    <div class="process">
                        <b>METHODE</b>
                        <table>
                            <thead>
                                <tr>
                                    <td>NO</td>
                                    <td>PROCESS</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Pastikan peralatan bersih dan tidak berbau</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Timbang pelarut yang digunakan</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Timbang <i>raw material</i> yang digunakan</td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Aduk dengan kecepatan 50Hz selama 30 menit sampai homogen dengan.</td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Cek QC</td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Packing dalam Boxes 25 Kg</td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Beri label</td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Simpan pada 10-20oC</td>
                                </tr>
                                <tr style="height: 12px">
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr style="height: 12px">
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="wheiging">
                        <b>WHEIGING</b>
                        <table>
                            <tr>
                                <td rowspan="2">TIME</td>
                                <td>START</td>
                                <td>FINISHED</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                        <b>PRODUCTION MACHINE</b>
                        <table>
                            <tr>
                                <td colspan="2">RPM</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="2">TEMPERATURE</td>
                                <td colspan="2"></td>
                            </tr>
                            <tr>
                                <td colspan="4">SETTING TIME MIXING</td>
                            </tr>
                            <tr>
                                <td colspan="2">QC CHECKED</td>
                                <td>YES</td>
                                <td>NO</td>
                            </tr>
                            <tr>
                                <td colspan="2" rowspan="2">ADJUSTMENT</td>
                                <td>RPM</td>
                                <td>TIME</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2" rowspan="2">TIME</td>
                                <td>START</td>
                                <td>FINISHED</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="package">
                <b>PACKAGING</b>
                <div class="package2">
                    <div class="kiri">
                        <div class="packaging">
                            <table class="time2">
                                <tr>
                                    <td rowspan="2">TIME</td>
                                    <td style="width: 60px">START</td>
                                    <td style="width: 60px">FINISHED</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                            <div class="item">
                                <table>
                                    <tr>
                                        <td>ITEM</td>
                                        <td>QTY</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="float"></div>
                        </div>
                        <div>
                            <b>LABELING</b>
                            <table style="width: 49%">
                                <tbody>
                                    <tr>
                                        <td style="width: 130px">LOCAL CODE</td>
                                        <td style="width: 140px"></td>
                                        <td>OK</td>
                                        <td style="width: 40px">NOT OK</td>
                                    </tr>
                                    <tr>
                                        <td>CUSTOMER CODE</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>EXPIRE DATE</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>PRODUCTION DATE</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>WAREHOUSE</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    {{-- <div class="float"></div> --}}
                    <div class="quantity">
                        <table class="qty">
                            <thead>
                                <tr>
                                    <td style="widht: 20px">No.</td>
                                    <td style="width: 50px">Qty (KG)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="qty">
                            <thead>
                                <tr>
                                    <td style="widht: 20px">No.</td>
                                    <td style="width: 50px">Qty (KG)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="qty">
                            <thead>
                                <tr>
                                    <td style="widht: 20px">No.</td>
                                    <td style="width: 50px">Qty (KG)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="qty">
                            <thead>
                                <tr>
                                    <td style="widht: 20px">No.</td>
                                    <td style="width: 50px">Qty (KG)</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="float"></div>
            <div class="labeling">
                <table>
                    <tbody>
                        <tr>
                            <td rowspan="3" style="width: 25rem">remark:</td>
                            <td>Dibuat Oleh</td>
                            <td>Diperiksa Oleh</td>
                            <td>Diketahui Oleh</td>
                        </tr>
                        <tr style="height: 200px">
                            <td style="height: 60px"></td>
                            <td style="height: 60px"></td>
                            <td style="height: 60px"></td>
                        </tr>

                        <tr>
                            <td>Production</td>
                            <td>QC Checked</td>
                            <td>PPIC</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>
