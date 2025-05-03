<!-- Register Page -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, rgb(20, 90, 180), rgb(25, 135, 84));
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-shape {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 0;
            background: linear-gradient(135deg, rgba(13, 110, 253, 0.6), rgba(25, 135, 84, 0.6));
            clip-path: polygon(0 0, 100% 0, 100% 75%, 0 100%);
        }

        .register-box {
            position: relative;
            z-index: 1;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
        }

        .register-title {
            color: rgb(13, 110, 253);
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-register {
            background-color: rgb(25, 135, 84);
            border: none;
        }

        .btn-register:hover {
            background-color: rgb(20, 110, 68);
        }

        .login-link {
            margin-top: 1rem;
            text-align: center;
        }

        .login-link a {
            color: rgb(13, 110, 253);
            text-decoration: none;
        }

        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <div class="bg-shape"></div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="register-box">
                    <h2 class="register-title">Create Your Account</h2>
                    @if(Session::has('fail'))
                    <h5 class="text-danger  text-center mt-1">{{Session::get('fail')}}</h5>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required placeholder="Your name">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required placeholder="you@example.com">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Create Password</label>
                            <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password" name="cpassword" required placeholder="••••••••">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-control" required>
                                <option value="employeer">Employer</option>
                                <option value="jobseeker">Job Seeker</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-register w-100">Register</button>
                    </form>

                    <div class="login-link">
                        <p>Already have an account? <a href="/login">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
