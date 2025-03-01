@extends('frontend.inc.app')
@section('title', env('APP_NAME').' | Home')

@section('css')
    <style>
        .error { color: red; font-size: 14px; }
    </style>
@endsection

@section('content')
    <section class="userLigin-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="" method="post" class="user_login" id="user_login">
                        @csrf
                        <div class="form-outer m-24 mb-44">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="name@example.com">
                            </div>
                            <input type="submit" class="btn btn-success" name="submit" id="submit" value="Login">
                            <div id="login-message" class="mt-2 text-danger"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#user_login').on('submit', function(e) {
                e.preventDefault();

                $('#login-message').text("");
                $('#submit').prop('disabled', true).text("Logging in...");

                $.ajax({
                    url: "{{ route('user.login') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('#login-message').removeClass('text-danger').addClass('text-success').text(response.message);
                            window.location.href = response.redirect;
                        } else {
                            $('#login-message').text(response.message);
                            $('#submit').prop('disabled', false).text("Login");
                        }
                    },
                    error: function(xhr) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = errors ? Object.values(errors).join('<br>') : 'Login failed. Please try again.';
                        $('#login-message').html(errorMsg);
                        $('#submit').prop('disabled', false).text("Login");
                    }
                });
            });
        });
    </script>
@endsection
