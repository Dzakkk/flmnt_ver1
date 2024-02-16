@extends('dashboard')

@section('productionControlAfter')
    
    
    <div class="d-flex">
      @foreach($pc as $p)
        <div class="card" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{ $p->no_production }}</h5>
              <p class="card-text"></p>
              <a href="/after/production/{{ $p->no_production }}" class="btn btn-primary">INPUT PRODUCTION DATA</a>
            </div>
          </div>
          @endforeach
    </div>


@endsection