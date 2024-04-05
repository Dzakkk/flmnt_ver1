@extends('dashboard')

@section('qc_form_inhouse')
    <style>
        /* Default styling for text */
        .demo {
            color: black;
            align-items: center;
            text-align: center;
            padding: 5px;
            border-radius: 5px;
        }

        /* Conditional styling based on range value */
        .range-slider[value="0"]+.demo,
        .range-slider[value="1"]+.demo {
            padding: 3px;
            background-color: green;
            border-radius: 10px;
        }

        .range-slider[value="2"]+.demo,
        .range-slider[value="3"]+.demo {
            padding: 3px;
            background-color: yellow;
            border-radius: 10px;
        }

        .range-slider[value="4"]+.demo,
        .range-slider[value="5"]+.demo {
            padding: 3px;
            background-color: red;
            border-radius: 10px;
        }

        .range-value {
            margin-left: 10px;
            align-items: center;
            text-align: center;
            padding: 5px;
            border-radius: 5px;
        }
    </style>

    <div>
        <div class="container shadow pt-2 mt-2 pb-2">
            <form action="/qc/post" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 row">
                    <label for="1" class="col-sm-2 col-form-label">No Production</label>
                    <div class="col-sm-10">
                        <input type="text" name="no_production" class="form-control-plaintext" id="1"
                            value="{{ $nl->no_production }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="2" class="col-sm-2 col-form-label">No Lot</label>
                    <div class="col-sm-10">
                        <input type="text" name="LOT" class="form-control" id="2"
                            value="{{ $nl->no_LOT }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="3" class="col-sm-2 col-form-label">Code</label>
                    <div class="col-sm-10">
                        <input type="text" name="FAI_code" class="form-control" id="3"
                            value="{{ $nl->FAI_code }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="4" class="col-sm-2 col-form-label">Product</label>
                    <div class="col-sm-10">
                        <input type="text" name="product_name" class="form-control" id="4"
                            value="{{ $prd->product_name }}">
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="5" class="form-label">Quantity</label>
                    <input type="text" name="qty" class="form-control" id="5" value="{{ $nl->quantity }}">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="6" class="form-label">Production Date</label>
                    <input type="text" name="tanggal_produksi" class="form-control" id="6"
                        value="{{ $nl->tanggal_produksi }}">
                </div>
                <div class="mb-3 row">
                    <label for="7" class="col-sm-2 col-form-label">Customer</label>
                    <div class="col-sm-10">
                        <select name="customer" id="7" class="form-control">
                            @foreach ($cust as $i)
                                <option value="{{ $i->customer_name }}">{{ $i->customer_name }}</option>
                            @endforeach
                        </select>
                        {{-- <input type="text" name="customer" class="form-control" id="7" value=""> --}}
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="8" class="col-sm-2 col-form-label">Test Methode</label>
                    <div class="col-sm-10">
                        <input type="text" name="test_methode" class="form-control" id="8" value="" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="9" class="col-sm-3 col-form-label">Spec</label>
                    <div class="col-sm-3">
                        <label for="9-1" class="form-label">Appereance</label>
                        <input type="text" name="appereance" class="form-control" id="9-1"
                            value="{{ $prd->aspect }}">
                    </div>
                    <div class="col-sm-3">
                        <label for="9-1" class="form-label">Range Color</label>
                        <input type="text" name="range_color" class="form-control" id="9-2"
                            value="{{ $prd->range_color }}">
                    </div>
                    <div class="col-sm-3">
                        <label for="9-1" class="form-label">Odour Taste</label>
                        <input type="text" name="odour_taste" class="form-control" id="9-3"
                            value="{{ $prd->odour_taste }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="10" class="col-sm-2 col-form-label">Check</label>

                    <div class="col-sm-10">
                        <div class="mb-3 row">
                            <label for="color_range" class="col-sm-2 col-form-label">Color</label>
                            <div class="col-sm-10">
                                <p class="range-value">Value</p>

                                <input type="range" name="color_value" class="form-range range-slider" min="0"
                                    max="5" id="color_range">
                                <p id="color_demo" class="demo">Result</p>
                            </div>

                        </div>

                        <!-- Input range for Odour -->
                        <div class="mb-3 row">
                            <label for="odour_range" class="col-sm-2 col-form-label">Odour</label>
                            <div class="col-sm-10">
                                <p class="range-value">Value</p>

                                <input type="range" name="odour_value" class="form-range range-slider" min="0"
                                    max="5" id="odour_range">
                                <p id="odour_demo" class="demo">Result</p>

                            </div>

                        </div>

                        <!-- Input range for Taste -->
                        <div class="mb-3 row">
                            <label for="taste_range" class="col-sm-2 col-form-label">Taste</label>
                            <div class="col-sm-10">
                                <p class="range-value">Value</p>
                                <input type="range" name="taste_value" class="form-range range-slider" min="0"
                                    max="5" id="taste_range">
                                <p id="taste_demo" class="demo">Result</p>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="mb-3 row">
                    <label for="10" class="col-sm-2 col-form-label">Check</label>
                    <div class="col-md-10">

                        <div class="col-md-12">
                            <label for="6" class="form-label">Spesific Gravity d20</label>
                            <div class="d-flex">
                                <div class="col-md-2 me-1">
                                    <label for="">min</label>
                                    <input type="text" name="sg_d20_min" id="sg_d20_min" class="form-control"
                                        value="{{ $prd->sg_d20_min }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">max</label>
                                    <input type="text" name="sg_d20_max" id="sg_d20_max" class="form-control"
                                        value="{{ $prd->sg_d20_max }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">target</label>
                                    <input type="text" name="sg_d20_target" id="" class="form-control"
                                        value="{{ $prd->sg_d20_target }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">value</label>
                                    <input type="number" name="sg_d20_value" id="value1" class="form-control">
                                </div>
                                <div class="col-md-3 me-1">
                                    <label for="">Result</label>
                                    <input type="text" name="sg_d20_result" id="result1" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="6" class="form-label">Spesific Gravity d25</label>
                            <div class="d-flex">
                                <div class="col-md-2 me-1">
                                    <label for="">min</label>
                                    <input type="text" name="sg_d25_min" id="sg_d25_min" class="form-control"
                                        value="{{ $prd->sg_d25_min }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">max</label>
                                    <input type="text" name="sg_d25_max" id="sg_d25_max" class="form-control"
                                        value="{{ $prd->sg_d25_max }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">target</label>
                                    <input type="text" name="sg_d25_target" id="sg_d25_target" class="form-control"
                                        value="{{ $prd->sg_d25_target }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">value</label>
                                    <input type="number" name="sg_d25_value" id="value2" class="form-control">
                                </div>
                                <div class="col-md-3 me-1">
                                    <label for="">Result</label>
                                    <input type="text" name="sg_d25_result" id="result2" class="form-control">
                                </div>
                            </div>

                        </div>
                        <div class="col-md-12">
                            <label for="6" class="form-label">Refractife Index d20</label>
                            <div class="d-flex">
                                <div class="col-md-2 me-1">
                                    <label for="">min</label>
                                    <input type="text" name="ri_d20_min" id="ri_d20_min" class="form-control"
                                        value="{{ $prd->ri_d20_min }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">max</label>
                                    <input type="text" name="ri_d20_max" id="ri_d20_max" class="form-control"
                                        value="{{ $prd->ri_d20_max }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">target</label>
                                    <input type="text" name="ri_d20_target" id="ri_d20_target" class="form-control"
                                        value="{{ $prd->ri_d20_target }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">value</label>
                                    <input type="number" name="ri_d20_value" id="value3" class="form-control">
                                </div>
                                <div class="col-md-3 me-1">
                                    <label for="">Result</label>
                                    <input type="text" name="ri_d20_result" id="result3" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="6" class="form-label">Refractife Index d25</label>
                            <div class="d-flex">
                                <div class="col-md-2 me-1">
                                    <label for="">min</label>
                                    <input type="text" name="ri_d25_min" id="ri_d25_min" class="form-control"
                                        value="{{ $prd->ri_d25_min }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">max</label>
                                    <input type="text" name="ri_d25_max" id="ri_d25_max" class="form-control"
                                        value="{{ $prd->ri_d25_max }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">target</label>
                                    <input type="text" name="ri_d25_target" id="ri_d25_target" class="form-control"
                                        value="{{ $prd->ri_d25_target }}">
                                </div>
                                <div class="col-md-2 me-1">
                                    <label for="">value</label>
                                    <input type="number" name="ri_d25_value" id="value4" class="form-control">
                                </div>
                                <div class="col-md-3 me-1">
                                    <label for="">Result</label>
                                    <input type="text" name="ri_d25_result" id="result4" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="mb-3 row">
                    <label for="3" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                       <select name="status" id="3" class="form-control">
                        <option value="PASS">PASS</option>
                        <option value="REJECT">REJECT</option>
                        <option value="Undefined">Undefined</option>
                       </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="4" class="col-sm-2 col-form-label">Note</label>
                    <div class="col-sm-10">
                        <input type="text" name="note" class="form-control" id="4" value="">
                    </div>
                </div>

                <script>
                    document.querySelectorAll('.form-range').forEach(function(element) {
                        element.addEventListener('input', function() {
                            var value = this.value;
                            var demo = document.querySelector('#' + this.id + '+.demo');
                            var rangeValue = this.parentElement.querySelector('.range-value');
                            rangeValue.textContent = value;
                            if (value == '0' || value == '1') {
                                demo.innerText = 'Pass';
                                demo.style.backgroundColor = 'green';
                            } else if (value == '2' || value == '3') {
                                demo.innerText = 'Need Verification';
                                demo.style.backgroundColor = 'yellow';
                            } else {
                                demo.innerText = 'Reject';
                                demo.style.backgroundColor = 'red';
                            }
                        });
                    });
                </script>

                <script>
                    document.getElementById('value1').addEventListener('input', function() {
                        var inputValue = parseFloat(this.value); // Dapatkan nilai input dan konversi ke float
                        var min = parseFloat(document.getElementById('sg_d20_min')
                        .value); // Dapatkan nilai min dan konversi ke float
                        var max = parseFloat(document.getElementById('sg_d20_max')
                        .value); // Dapatkan nilai max dan konversi ke float
                        var resultInput = document.getElementById('result1');

                        if (inputValue < min || inputValue > max) {
                            resultInput.value = 'Outspec';
                            resultInput.style.backgroundColor = 'red'; // Ganti warna latar belakang
                        } else {
                            resultInput.value = 'Inspec';
                            resultInput.style.backgroundColor = 'green'; // Kembalikan warna latar belakang ke default
                        }
                    });
                    document.getElementById('value2').addEventListener('input', function() {
                        var inputValue = parseFloat(this.value); // Dapatkan nilai input dan konversi ke float
                        var min = parseFloat(document.getElementById('sg_d25_min')
                        .value); // Dapatkan nilai min dan konversi ke float
                        var max = parseFloat(document.getElementById('sg_d25_max')
                        .value); // Dapatkan nilai max dan konversi ke float
                        var resultInput = document.getElementById('result2');

                        if (inputValue < min || inputValue > max) {
                            resultInput.value = 'Outspec';
                            resultInput.style.backgroundColor = 'red'; // Ganti warna latar belakang
                        } else {
                            resultInput.value = 'Inspec';
                            resultInput.style.backgroundColor = 'green'; // Kembalikan warna latar belakang ke default
                        }
                    });
                    document.getElementById('value3').addEventListener('input', function() {
                        var inputValue = parseFloat(this.value); // Dapatkan nilai input dan konversi ke float
                        var min = parseFloat(document.getElementById('ri_d20_min')
                        .value); // Dapatkan nilai min dan konversi ke float
                        var max = parseFloat(document.getElementById('ri_d20_max')
                        .value); // Dapatkan nilai max dan konversi ke float
                        var resultInput = document.getElementById('result3');

                        if (inputValue < min || inputValue > max) {
                            resultInput.value = 'Outspec';
                            resultInput.style.backgroundColor = 'red'; // Ganti warna latar belakang
                        } else {
                            resultInput.value = 'Inspec';
                            resultInput.style.backgroundColor = 'green'; // Kembalikan warna latar belakang ke default
                        }
                    });
                    document.getElementById('value4').addEventListener('input', function() {
                        var inputValue = parseFloat(this.value); // Dapatkan nilai input dan konversi ke float
                        var min = parseFloat(document.getElementById('ri_d25_min')
                        .value); // Dapatkan nilai min dan konversi ke float
                        var max = parseFloat(document.getElementById('ri_d25_max')
                        .value); // Dapatkan nilai max dan konversi ke float
                        var resultInput = document.getElementById('result4');

                        if (inputValue < min || inputValue > max) {
                            resultInput.value = 'Outspec';
                            resultInput.style.backgroundColor = 'red'; // Ganti warna latar belakang
                        } else {
                            resultInput.value = 'Inspec';
                            resultInput.style.backgroundColor = 'green'; // Kembalikan warna latar belakang ke default
                        }
                    });
                </script>


                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>

                </div>

            </form>
        </div>
    </div>
@endsection
