<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

</head>

<body>

    <section class="h-100 gradient-form" style="background-color: #7D0A0A;" >
        <div class="container py-5 h-100" style="background-color: #7D0A0A">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0" style="background-color: #EAD196">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                <form action="/loginUser" method="POST">
                                        @csrf

                                        <h1>Login</h1>
                                        <p>Please login to your account</p>

                                        <div class="form-floating mb-4">
                                            <input type="text" name="name" id="" class="form-control"
                                                placeholder="nip" value="{{ old('name') }}">
                                            <label for="nip" class="form-label"><i
                                                    class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;Username</label>
                                        </div>

                                        <div class="form-floating mb-4">
                                            <input type="password" name="password" id="" class="form-control"
                                                placeholder="password">
                                            <label for="password" class="form-label"><i
                                                    class="fa fa-lock"></i>&nbsp;&nbsp;&nbsp;password</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button
                                                class="btn btn-warning container-fluid btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">
                                                Log in
                                            </button>

                                        </div>

                                        {{-- <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <a type="button" class="btn btn-outline-danger" href="/register">Create
                                                new</a>
                                        </div> --}}

                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6">
                            <img src="{{ asset('images/icon_login.png') }}" alt="login" width="400" >
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $item)
                                            <li>{{ $item }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>