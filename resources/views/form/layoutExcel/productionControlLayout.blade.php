<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>export excel</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th valign="center" rowspan="2">No. Production</th>
                <th valign="center" rowspan="2">Production Date</th>
                <th valign="center" rowspan="2">No. Work Order</th>
                <th valign="center" rowspan="2">Product Name</th>
                <th valign="center"  rowspan="2">Qty. Production</th>
                <th valign="center" rowspan="2">Lot. Number</th>
                <th valign="center" rowspan="2">Local Code</th>
                <th valign="center" rowspan="2">Customer Name</th>
                <th valign="center" rowspan="2">Customer Code</th>
                <th valign="center" rowspan="2">PO. Customer</th>
                <th align="center" colspan="2">TANK</th>
                <th align="center" colspan="2">TIME</th>
                <th align="center" colspan="2">WHEIGING</th>
                <th valign="center" rowspan="2">RPM</th>
                <th valign="center" rowspan="2">TEMPERATURE</th>
                <th valign="center" rowspan="2">SETTING TIME MIXING</th>
                <th valign="center" rowspan="2">QC CHECKED</th>
                <th align="center" colspan="2">ADJUSTMENT</th>
                <th align="center" colspan="2">TIME</th>
                <th align="center" colspan="4">PACKAGING</th>
                <th valign="center" rowspan="2">WAREHOUSE</th>
            </tr>
            <tr>
                <th>CLEANLESS</th>
                <th>ODDORLESS</th>
                <th>START</th>
                <th>FINISHED</th>
                <th>START</th>
                <th>FINISHED</th>
                <th>RPM</th>
                <th>TIME</th>
                <th>START</th>
                <th>FINISHED</th>
                <th>START</th>
                <th>FINISHED</th>
                <th>ITEM</th>
                <th>QTY</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prd as $i)
                
            <tr>
                <td>{{ $i->no_production }}</td>
                <td>{{ $i->stockl->tanggal_produksi }}</td>
                <td>{{ $i->stockl->tanggal_expire }}</td>
                <td>{{ $i->stockl->no_work_order }}</td>
                <td>{{ $i->stockl->nama_product }}</td>
                <td>{{ $i->stockl->quantity }}</td>
                <td>{{ $i->stockl->no_LOT }}</td>
                <td>{{ $i->FAI_code }}</td>
                <td>{{ $i->cust->customer_name }}</td>
                <td>{{ $i->cust->customer_code }}</td>
                <td>{{ $i->cust->PO_customer }}</td>
                <td>{{ $i->cleanless }}</td>
                <td>{{ $i->oddorless }}</td>
                <td>{{ $i->preparation_start }}</td>
                <td>{{ $i->preparation_finish }}</td>
                <td>{{ $i->wheiging_start }}</td>
                <td>{{ $i->wheiging_finish }}</td>
                <td>{{ $i->rpm }}</td>
                <td>{{ $i->temperature }}</td>
                <td>{{ $i->setting_time_mixing }}</td>
                <td>{{ $i->QC_checked }}</td>
                <td>{{ $i->adjustment_rpm }}</td>
                <td>{{ $i->adjustment_time }}</td>
                <td>{{ $i->production_time_start }}</td>
                <td>{{ $i->production_time_finish }}</td>
                <td></td>
                <td></td>
                <td>{{ $i->packaging_qty }}</td>
                <td>{{ $i->warehouse }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>
</body>
</html>