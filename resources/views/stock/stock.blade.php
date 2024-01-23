@extends('dashboard')

@section('stock')

<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">FAI code</th>
        <th scope="col">Product Name</th>
        <th scope="col">Common Name</th>
        <th scope="col">aspect</th>
        <th scope="col">categoty</th>
        <th scope="col">quantity</th>
        <th scope="col">unit</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($stock as $i)
      <tr>
        <th scope="row">{{ $i->FAI_code }}</th>
        <td>{{ $i->product_name }}</td>
        <td>{{ $i->common_name }}</td>
        <td>{{ $i->aspect }}</td>
        <td>{{ $i->category }}</td>
        <td>{{ $i->quantity }}</td>
        <td>{{ $i->unit }}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
    
@endsection