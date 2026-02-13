<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <title>Login</title>
</head>

<body>
    <div style="background-image: linear-gradient(135deg, #0f9d58, #34d058, #7ed957, #b4ec51)" class="">
        <div class="container">
            <div class="row justify-content-center align-items-center d-flex vh-100">
                <div class="col-md-4 px-3 mx-auto my-auto bg-white py-3 rounded-2">
                    <h5 class="text-center mb-5">Database Monev Bidang Pengendalian Silahkan Login</h5>
                    <form action="{{ route('login.store') }}" method="post">
                        @csrf
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input name="email" type="username"  class="form-control"
                                placeholder="Email" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4">
                            <input name="password" type="password" id="form2Example22" class="form-control"
                                placeholder="Password" />
                        </div>

                        <div class="text-end pt-1 mb-5 pb-1">
                            <button data-mdb-button-init data-mdb-ripple-init
                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3 w-100"
                                type="submit">Signin</button>
                            {{-- <a class="text-muted" href="#!">Forgot password?</a> --}}
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/adminlte.min.js') }}"></script>
</body>

</html>
