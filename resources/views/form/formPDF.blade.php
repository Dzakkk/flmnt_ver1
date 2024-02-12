<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <div class="container">
    <div>
        <table>
            <tbody>
                <tr style="height: 25px">
                    {{-- <td rowspan="5" style="width: 10%;"><img src="{{ asset('images/logo.png') }}" alt="logo" width="150rem"></td> --}}
                    <td rowspan="2" style="text-align: center;"><h2>FORM</h2></td>
                    <td style="width: 11%;">Kode Dokumen</td>
                    <td style="width: 11%;">: FRM - PRD - 00</td>
                </tr>
                <tr style="height: 25px">
                    <td>Level Dokumen</td>
                    <td>: IV</td>
                </tr>
                <tr style="height: 25px">
                    <td rowspan="3" style="text-align: center;"><h2>PRODUCTION CONTROL</h2></td>
                    <td>Revisi</td>
                    <td>: 1</td>
                </tr>
                <tr style="height: 25px">
                    <td>Tanggal Efektif</td>
                    <td>: 4 Desember 2023</td>
                </tr>
                <tr style="height: 25px">
                    <td>Kadaluarsa</td>
                    <td>: 3 Desember 2023</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="general-info">
        <div class="general">
            <div class="gen">
                <div>
                    <label for=""><h3>No.&nbsp;Production</h3></label>:
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>Production&nbsp;Date</h3></label>:
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>No.&nbsp;Work&nbsp;Order</h3></label>:
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>Product&nbsp;Name</h3></label>:
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>Qty&nbsp;Production</h3></label>:
                    <input type="text">KG
                </div>
            </div>
            <div class="gen">
                <div>
                    <label for=""><h3>Lot&nbsp;Number</h3></label>
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>Local&nbsp;Code</h3></label>
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>Customer&nbsp;Name</h3></label>
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>Customer&nbsp;Code</h3></label>
                    <input type="text">
                </div>
                <div>
                    <label for=""><h3>Po.&nbsp;Customer</h3></label>
                    <input type="text">
                </div>
            </div>
        </div>
    </div>
    <div class="preparation">
        <h4>PREPARATION</h4>
        <div class="pre">
            <div>
                <h5>TANK</h5>
                <table>
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
            <div>
                <h5>TIME</h5>
                <table>
                    <tbody>
                        <tr>
                            <th>START</th>
                            <th>FINISHED</th>
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
    <div class="product-formula">
        <h4>PRODUCT FORMULA</h4>
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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
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
                <h4>METHODE</h4>
                <table>
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>PROCESS</th>
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
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="wheiging">
                <h4>WHEIGING</h4>
                <table>
                    <tr>
                        <th rowspan="2">TIME</th>
                        <th>START</th>
                        <th>FINISHED</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
                <h4>PRODUCTION MACHINE</h4>
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
        <h4>PACKAGING</h4>
        <div class="package2">
            <div>
                <div class="packaging">
                    <table>
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
                    &nbsp;&nbsp;
                    <table>
                        <tr>
                            <th>ITEM</th>
                            <th>QTY</th>
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
                <div>
                    <h4>LABELING</h4>
                    <table>
                        <tbody>
                            <tr>
                                <th>LOCAL CODE</th>
                                <td style="width: 300px"></td>
                                <th style="width: 70px">OK</th>
                                <th style="width: 70px">NOT OK</th>
                            </tr>
                            <tr>
                                <th>CUSTOMER CODE</th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>EXPIRE DATE</th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>PRODUCTION DATE</th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th>WAREHOUSE</th>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="quantity">
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Qty (KG)</th>
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
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Qty (KG)</th>
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
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Qty (KG)</th>
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
                <table>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Qty (KG)</th>
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
    <div class="labeling">
        <table>
            <tbody>
                <tr>
                    <td rowspan="5" style="width: 25rem">remark:</td>
                    <td>Dibuat Oleh</td>
                    <td>Diperiksa Oleh</td>
                    <td>Diketahui Oleh</td>
                </tr>
                <tr style="height: 80px">
                    <td rowspan="3"></td>
                    <td rowspan="3"></td>
                    <td rowspan="3"></td>
                </tr>
                <tr></tr>
                <tr></tr>
                <tr>
                    <td>Production</td>
                    <td>QC Checked</td>
                    <td>PPIC</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>