@extends('dashboard')

@section('dataProduction')
    
<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">no_production</th>
            <th scope="col">FAI Code</th>
            <th scope="col">cleanless</th>
            <th scope="col">oddorless</th>
            <th scope="col">Tanggal Produksi</th>
            <th scope="col">Tanggal Expire</th>
            <th scope="col">QC Checked</th>
            <th scope="col">Status</th>
            <th scope="col">Note</th>
            {{-- <th scope="col">Temperature</th>
            <th scope="col">Setting Time Mixing</th>
            <th scope="col">QC Checked </th> --}}
            <th scope="col">Warehouse</th>
            <th scope="col">ACTION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($prd as $i)
            <tr>
                <th scope="row" style="font-size: 14px;">{{ $i->no_production }}</th>
                <td style="font-size: 14px;">{{ $i->FAI_code }}</td>
                <td style="font-size: 14px;">{{ $i->cleanless }}</td>
                <td style="font-size: 14px;">{{ $i->oddorless }}</td>
                <td style="font-size: 14px;">{{ $i->stockl->tanggal_produksi }}</td>
                <td style="font-size: 14px;">{{ $i->stockl->tanggal_expire }}</td>
                <td style="font-size: 14px;">{{ $i->QC_checked }}</td>
                <td style="font-size: 14px;">{{ $i->qc_check->status }}</td>
                <td style="font-size: 14px;">{{ $i->qc_check->note }}</td>
                {{-- <td style="font-size: 14px;">{{ $i->temperature }}</td>
                <td style="font-size: 14px;">{{ $i->setting_time_mixing }}</td>
                <td style="font-size: 14px;">{{ $i->QC_checked }}</td> --}}
                <td style="font-size: 14px;">{{ $i->warehouse }}</td>
                <td>
                    <div class="d-flex">
                        <a href="/after/production/{{ $i->no_production }}" class="btn btn-primary btn-sm me-1"><i class="ri-edit-line"></i></a>

                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal-{{ $i->FAI_code }}"><i class="bi bi-trash"></i></button>
                    </div>
                </td>
            </tr>
            <div class="modal fade" id="confirmDeleteModal-{{ $i->FAI_code }}" tabindex="-1"
                aria-labelledby="confirmDeleteModalLabel-{{ $i->FAI_code }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $i->FAI_code }}">Confirm Deletion
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this record?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>

                            {{-- <form action="{{ route('product.delete', $i->FAI_code) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Confirm Delete</button>
                            </form> --}}

                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>
<a href="/export/production/control" class="btn btn-primary">export excel</a>
@endsection