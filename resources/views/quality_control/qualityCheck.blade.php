@extends('dashboard')

@section('qc_check')
    <style>
        #slideshow {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        .slide-container {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            flex: 0 0 100%;
            max-width: 100%;
            transition: opacity 0.5s ease-in-out;
        }

        .pagination {
            margin-top: 20px; /* Sesuaikan dengan kebutuhan Anda */
            text-align: center;
        }

        .prev,
        .next {
            background: #ccc;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
    </style>
    
    <div id="slideshow">
        <div class="slide-container">
            <div class="table-responsive slide active p-2">
                <h3>Inhouse</h3>

                <table class="table table-hover shadow">
                    <thead>
                        <tr>
                            <td rowspan="2">Lot</td>
                            <td rowspan="2">Code</td>
                            <td rowspan="2">Product Name</td>
                            <td rowspan="2">Qty</td>
                            <td rowspan="2">Customer</td>
                            <td rowspan="2">Tanggal Produksi</td>
                            <td rowspan="2">Note</td>
                            <td rowspan="2">status</td>
                        </tr>

                    </thead>
                    <tbody>
                        @foreach ($prd as $i)
                            <tr>
                                <td>{{ $i->qc_check->LOT ?? null }}</td>
                                <td>{{ $i->FAI_code ?? null }}</td>
                                <td>{{ $i->qc_check->product_name ?? null }}</td>
                                <td>{{ $i->qc_check->qty ?? null }}</td>
                                <td>{{ $i->qc_check->customer ?? null }}</td>
                                <td>{{ $i->qc_check->tanggal_produksi ?? null }}</td>

                                <td>{{ $i->qc_check->note ?? null }}</td>
                                <td>{{ $i->qc_check->status ?? null }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
               
            </div>
            <div class="table-responsive slide p-2">
                <h3>Incoming</h3>

                <table class="table table-hover shadow">
                    <thead>
                        <tr>
                            <td rowspan="2">Lot</td>
                            <td rowspan="2">Code</td>
                            <td rowspan="2">Product Name</td>
                            <td rowspan="2">Qty</td>
                            <td rowspan="2">Customer</td>
                            <td rowspan="2">Tanggal Produksi</td>
                            
                            <td rowspan="2">Note</td>
                            <td rowspan="2">status</td>
                        </tr>
                   
                    </thead>
                    <tbody>


                        @foreach ($brg as $i)
                            <tr>
                                <td>{{ $i->qc_check->LOT ?? null }}</td>
                                <td>{{ $i->FAI_code ?? null }}</td>
                                <td>{{ $i->qc_check->product_name ?? null }}</td>
                                <td>{{ $i->qc_check->qty ?? null }}</td>
                                <td>{{ $i->qc_check->customer ?? null }}</td>
                                <td>{{ $i->qc_check->tanggal_produksi ?? null }}</td>
                                <td>{{ $i->qc_check->note ?? null }}</td>
                                <td>{{ $i->qc_check->status ?? null }}</td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                
            </div>
        </div>
        <div class="pagination">
            {{ $prd->links() }}
        </div>
    
        <div class="controls">
            <button onclick="nextSlide()" class="btn btn-primary">Pindah</button>
        </div>
    </div>




    <script>
        var slidesContainer = document.querySelector('.slide-container');
        var slides = document.querySelectorAll('.slide');
        var currentSlide = 0;

        function showSlide(n) {
            currentSlide = (n + slides.length) % slides.length;
            slidesContainer.style.transform = 'translateX(-' + currentSlide * 100 + '%)';
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        
    </script>
@endsection
