<html>
<head>
    <link rel="stylesheet" type="text/css" href="mobileui/style.css">
    <meta name="format-detection" content="telephone=no">
    <meta charset="utf-8">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width">
    <meta http-equiv="Content-Security-Policy" content="connect-src *;" />
    <link rel="stylesheet" type="text/css" href="{{url('vlogin/css/index.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('vlogin/css/fontawesome.min.css')}}">

    <title>PRESENSI | Login</title>
</head>
<style>
    :root {
        --input-padding-x: 1.5rem;
        --input-padding-y: .75rem;
    }

    body {
        background: #007bff;
        /* background: linear-gradient(to right, #0062E6, #33AEFF); */
        background: linear-gradient(to right, #1C4994, #10586E);
    }

    .card-signin {
        border: 0;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
    }

    .card-signin .card-title {
        margin-bottom: 2rem;
        font-weight: 300;
        font-size: 1.5rem;
    }

    .card-signin .card-body {
        padding: 2rem;
    }

    .form-signin {
        width: 100%;
    }

    .form-signin .btn {
        font-size: 80%;
        border-radius: 5rem;
        letter-spacing: .1rem;
        font-weight: bold;
        padding: 1rem;
        transition: all 0.2s;
    }

    .form-label-group {
        position: relative;
        margin-bottom: 1rem;
    }

    .form-label-group input {
        height: auto;
        border-radius: 2rem;
    }

    .form-label-group>input,
    .form-label-group>label {
        padding: var(--input-padding-y) var(--input-padding-x);
    }

    .form-label-group>label {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 100%;
        margin-bottom: 0;
        /* Override default `<label>` margin */
        line-height: 1.5;
        color: #495057;
        border: 1px solid transparent;
        border-radius: .25rem;
        transition: all .1s ease-in-out;
    }

    .form-label-group input::-webkit-input-placeholder {
        color: transparent;
    }

    .form-label-group input:-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-ms-input-placeholder {
        color: transparent;
    }

    .form-label-group input::-moz-placeholder {
        color: transparent;
    }

    .form-label-group input::placeholder {
        color: transparent;
    }

    .form-label-group input:not(:placeholder-shown) {
        padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
        padding-bottom: calc(var(--input-padding-y) / 3);
    }

    .form-label-group input:not(:placeholder-shown)~label {
        padding-top: calc(var(--input-padding-y) / 3);
        padding-bottom: calc(var(--input-padding-y) / 3);
        font-size: 12px;
        color: #777;
    }

    .btn-google {
        color: white;
        background-color: #ea4335;
    }

    .btn-facebook {
        color: white;
        background-color: #3b5998;
    }

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
    .form-label-group>label {
        display: none;
    }
    .form-label-group input::-ms-input-placeholder {
        color: #777;
    }
}

/* Fallback for IE
-------------------------------------------------- */

@media all and (-ms-high-contrast: none),
(-ms-high-contrast: active) {
    .form-label-group>label {
        display: none;
    }
    .form-label-group input:-ms-input-placeholder {
        color: #777;
    }
    }.loader {
        margin-bottom:auto;
        margin-left:auto;
        margin-top:auto;
        margin-right:auto;
        border: 16px solid #f3f3f3;
        border-radius: 50%;
        border-top: 16px solid #3498db;
        width: 80px;
        height: 80px;
        -webkit-animation: spin 2s linear infinite; /* Safari */
        animation: spin 2s linear infinite;
    }

    /* Safari */
    @-webkit-keyframes spin {
        0% { -webkit-transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .buttonload {
        /* Green background */
        border: none; /* Remove borders */
        color: white; /* White text */
        padding: 12px 24px; /* Some padding */
        font-size: 16px; /* Set a font-size */
    }

    /* Add a right margin to each icon */
    .fa {
        margin-left: -12px;
        margin-right: 8px;
    }

</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin" style="margin-top: 5rem;">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <img src="img/logo.png" style="width: 30%;">
                        </div>
                        <br>
                        <div class="card-title text-center">
                            <h4>PRESENSI</h4>
                            <small style="font-size: 0.6em;">Universitas Muhammadiyah Gresik</small>
                        </div>
                        <form method="POST" class="mt-3" action="{{ route('login') }}">
                            @csrf
                            <div class="form-signin" id="">
                                <div class="form-label-group">
                                    <input type="text" name="login" id="username" class="form-control" placeholder="Username">
                                    <label for="username">Username / Email</label>
                                    @if ($errors->has('username') || $errors->has('email'))
                                        <small id="" class="text-danger text-center">
                                            {{ $errors->first('username') ?: $errors->first('email') }}
                                        </small>
                                    @endif
                                </div>

                                <div class="form-label-group">
                                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                                    <label for="password">Password</label>
                                    @error('password')
                                        <small id="" class="text-danger text-center">
                                            {{$message}}
                                        </small>
                                    @enderror
                                </div>
                                <br>
                                <div class="loadera" id="loading"></div>
                                <button class="btn btn-lg btn-primary btn-block text-uppercase buttonload" type="submit" id="login">Masuk</button>
                            </form>
                            <div class="flex-c-m" style="margin-top:10px;text-align:center;">
                                <a href="{{url('')}}" class="txt2">
                                    Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal"></div>
</body>

<script type="text/javascript" src="{{url('vlogin/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('vlogin/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{url('vlogin/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('vlogin/mobileui/mobileui.js')}}"></script>

</body>
</html>
