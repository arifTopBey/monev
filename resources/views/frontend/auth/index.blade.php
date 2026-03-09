<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    <link rel="icon" href="{{ asset('image/monev.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">


    <title>Login</title>
</head>

<body>
    <div style="background-image: linear-gradient(135deg, #0f9d58, #34d058, #7ed957, #b4ec51)" class="">
        <div class="container">
            <div class="row justify-content-center align-items-center d-flex vh-100">
                <div class="col-md-4 px-3 mx-auto my-auto bg-white py-3 rounded-2">
                    <h5 class="text-center mb-5">Database Monev Bidang Pengendalian Silahkan Login</h5>
                    @error('email')
                       <div id="error-login" class="alert alert-danger" role="alert">
                            {{ $message }}
                        </div>
                    @enderror
                    <form action="{{ route('login.store') }}" method="post">
                        @csrf
                        <div data-mdb-input-init class="form-outline mb-4">
                            <input name="email" type="username"  class="form-control"
                                placeholder="Email" />
                        </div>

                        <div data-mdb-input-init class="form-outline mb-4 input-group">
                            <input id="passwordInput" name="password" type="password" id="form2Example22" class="form-control"
                                placeholder="Password" />

                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                <i class="bi bi-eye" id="eyeIcon"><img id="eyeIconImg" style="height: 20px;" src="{{ asset('image/hidden.png') }}" alt=""></i>
                            </button>
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
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            const alert = document.getElementById('error-login');
            
            if (alert) {
                setTimeout(function() {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    
                    setTimeout(function() {
                        alert.remove();
                    }, 500); 
                }, 5000);
            }
        });

        const togglePassword = document.querySelector('#togglePassword');
        const passwordInput = document.querySelector('#passwordInput');
        const eyeIconImg = document.querySelector('#eyeIconImg');
        const imgHidden = "{{ asset('image/hidden.png') }}";
        const imgEye = "{{ asset('image/eye.png') }}";

        togglePassword.addEventListener('click', function () {

           const isPassword = passwordInput.getAttribute('type') === 'password';
            
            // Tukar tipe input
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            
            // Tukar sumber gambar (src)
            eyeIconImg.src = isPassword ? imgEye : imgHidden;
        })
        
    </script>
</body>

</html>
