@extends('dashboard')

@section('cas')
    <div>
        <form action="/cas/add" method="post" enctype="multipart/form-data">
        <input type="text" name="CAS">
        <input type="text" name="nama_kimia" id="">
        <input type="text" name="kosmetik">
        <input type="text" name="pangan">
        <button type="submit">submit</button>
        </form>
    </div>
    <div>
        <form action="/import/cas" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" id="">
            <button type="submit">Submit</button>
        </form>
    </div>
@endsection