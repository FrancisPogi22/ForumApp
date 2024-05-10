<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.headPackage')
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
    @include('partials.header')

    <section id="login">
        <div class="wrapper">
            <div class="login-con">
                <div class="login-details-con">
                    <h2>Forum App</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque cumque eveniet eos, aliquid illo
                        iure vitae animi ab temporibus pariatur.</p>
                </div>
                <div class="login-form-con">
                    <form action="{{ route('login.user') }}" method="POST">
                        @csrf
                        <div class="field-con">
                            <input type="text" name="email" class="form-control"
                                value="{{ !empty(old('email')) ? old('email') : null }}" placeholder="Email">
                        </div>
                        <div class="field-con password-toggle">
                            <input type="password" name="password" class="form-control" id="authPassword" placeholder="Password">
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                        <div class="btn-con">
                            <button type="submit" class="btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @include('partials.plugins')
    @include('partials.script')
    @include('partials.toastr')
    <script>
        $(document).ready(() => {
            $(document).on('click', '#togglePassword', function() {
                const authPassword = $("#authPassword");
                authPassword.attr('type', authPassword.attr('type') == 'password' ? 'text' : 'password');
                $(this).toggleClass("bi-eye-slash bi-eye");
            });
        });
    </script>
</body>

</html>
