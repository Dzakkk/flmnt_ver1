@extends('dashboard')

@section('formAfterProduction')
    @livewireStyles
    <div class="mb-2 shadow">
        <div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $stockl->FAI_code }} - {{ $stockl->product->product_name }}
                    </h5>
                    <p class="card-text">{{ $prc->no_production }}</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">LOT : {{ $stockl->no_LOT }} || QTY : {{ $stockl->quantity }}</li>
                    <li class="list-group-item">Production Date : {{ $stockl->tanggal_produksi }}</li>
                    <li class="list-group-item">Production Expire : {{ $stockl->tanggal_expire }}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class=" shadow p-3 pt-2">
        <form class="row g-3 d-flex mt-3" action="/after/production/control/{{ $prc->no_production }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Cleanless</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cleanless" id="gridRadios1" value="yes"
                            checked>
                        <label class="form-check-label" for="gridRadios1">
                            yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="cleanless" id="gridRadios2" value="no">
                        <label class="form-check-label" for="gridRadios2">
                            no
                        </label>
                    </div>
                </div>
            </fieldset>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">Oddorless</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="oddorless" id="gridRadios1" value="yes"
                            checked>
                        <label class="form-check-label" for="gridRadios1">
                            yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="oddorless" id="gridRadios2" value="no">
                        <label class="form-check-label" for="gridRadios2">
                            no
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Preparation Time</label>
                <div class="col-sm-10 d-flex">
                    <input type="text" class="form-control me-1" name="preparation_start" id="inputEmail3"
                        placeholder="START" value="{{ $prc->preparation_start }}">
                    <input type="text" class="form-control ms-1" name="preparation_finish" id="inputEmail3"
                        placeholder="FINISHED" value="{{ $prc->preparation_finish }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Wheiging Time</label>
                <div class="col-sm-10 d-flex">
                    <input type="text" class="form-control me-1" name="wheiging_start" id="inputEmail3"
                        placeholder="START" value="{{ $prc->wheiging_start }}">
                    <input type="text" class="form-control ms-1" name="wheiging_finish" id="inputEmail3"
                        placeholder="FINISHED" value="{{ $prc->wheiging_finish }}">
                </div>
            </div>
            <h4>PRODUCTION MACHINE</h4>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">RPM</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="rpm"
                        value="{{ $prc->rpm }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Temperature</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="temperature"
                        value="{{ $prc->temperature }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Setting Time Mixing</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputPassword3" name="setting_time_mixing"
                        value="{{ $prc->setting_time_mixing }}">
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-2 pt-0">QC Checked</legend>
                <div class="col-sm-10">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="QC_checked" id="gridRadios1"
                            value="yes">
                        <label class="form-check-label" for="gridRadios1">
                            yes
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="QC_checked" id="gridRadios2"
                            value="no" checked>
                        <label class="form-check-label" for="gridRadios2">
                            no
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Adjustment</label>
                <div class="col-sm-10 d-flex">
                    <input type="text" class="form-control me-1" name="adjustment_rpm" id="inputEmail3"
                        placeholder="RPM" value="{{ $prc->adjustment_rpm }}">
                    <input type="text" class="form-control ms-1" name="adjustment_time" id="inputEmail3"
                        placeholder="TIME" value="{{ $prc->adjustment_time }}">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Adjustment Time</label>
                <div class="col-sm-10 d-flex">
                    <input type="text" class="form-control me-1" name="production_time_start" id="inputEmail3"
                        placeholder="START" value="{{ $prc->production_time_start }}">
                    <input type="text" class="form-control ms-1" name="production_time_finish" id="inputEmail3"
                        placeholder="FINISHED" value="{{ $prc->production_time_finish }}">
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Packaging Time</label>
                <div class="col-sm-10 d-flex">
                    <input type="text" class="form-control me-1" name="packaging_time_start" id="inputEmail3"
                        placeholder="START" value="{{ $prc->packaging_time_start }}">
                    <input type="text" class="form-control ms-1" name="packaging_time_finish" id="inputEmail3"
                        placeholder="FINISHED" value="{{ $prc->packaging_time_finish }}">
                </div>
            </div>
            {{-- <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Quantity/kemasan (KG)</label>
                <div class="col-sm-10 d-flex">
                    <input type="text" name="packaging_qty[]" class="form-control me-2">
                </div>
            </div> --}}
            @livewire('product-control', ['packaging_qty' => $packaging_qty])
            @livewireScripts
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Warehouse</label>
                <div class="col-sm-10">
                    <select name="warehouse" id="inputEmail3" class="form-control select2" required>
                        <option value="{{ $prc->warehouse }}">{{ $prc->warehouse }}</option>
                        @foreach ($rak as $r)
                            <option value="{{ $r->id_rak }}">{{ $r->id_rak }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Remark</label>
                <div class="col-sm-10">
                    <textarea name="remark" id="inputEmail3" cols="30" rows="3" class="form-control" placeholder="Remark">{{ $prc->remark }}</textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">File</label>
                <div class="col-sm-10 d-flex">
                    <input type="file" class="form-control me-1" name="file" id="inputEmail3"
                        placeholder="Image Production Control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>

        </form>

    </div>
@endsection
