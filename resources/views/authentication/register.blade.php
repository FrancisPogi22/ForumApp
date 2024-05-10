<!DOCTYPE html>
<html lang="en">

<head>
    @include('partials.headPackage')
    <link rel="stylesheet" href="{{ asset('assets/css/register.css') }}">
</head>

<body>
    @include('partials.header')

    <section id="register">
        <div class="wrapper">
            <div class="register-con">
                <div class="register-details-con">
                    <h2>Forum App</h2>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Itaque cumque eveniet eos, aliquid illo
                        iure vitae animi ab temporibus pariatur.</p>
                </div>
                <div class="register-form-con">
                    <form action="{{ route('register.user') }}" method="POST">
                        @csrf
                        <div class="field-con">
                            <input type="text" name="username" class="form-control"
                                value="{{ !empty(old('username')) ? old('username') : null }}" placeholder="Username"
                                required>
                        </div>
                        <div class="field-con">
                            <input type="text" name="name" class="form-control"
                                value="{{ !empty(old('name')) ? old('name') : null }}" placeholder="Full Name" required>
                        </div>
                        <div class="field-con">
                            <input type="text" name="email" class="form-control"
                                value="{{ !empty(old('email')) ? old('email') : null }}" placeholder="Email" required>
                        </div>
                        <div class="field-con password-toggle">
                            <input type="password" name="password" class="form-control" id="authPassword"
                                placeholder="Password" required>
                            <i class="bi bi-eye-slash" id="togglePassword"></i>
                        </div>
                        <div class="field-con Cpassword-toggle">
                            <input type="password" name="Cpassword" class="form-control" id="authCPassword"
                                placeholder="Confirm Password" required>
                            <i class="bi bi-eye-slash" id="toggleCPassword"></i>
                        </div>
                        <div class="btn-con">
                            <button type="submit" class="btn-primary">Register</button>
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

            $(document).on('click', '#toggleCPassword', function() {
                const authPassword = $("#authCPassword");
                authPassword.attr('type', authPassword.attr('type') == 'password' ? 'text' : 'password');
                $(this).toggleClass("bi-eye-slash bi-eye");
            });
        });
    </script>
</body>

</html>
