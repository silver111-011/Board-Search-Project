<!-- Login Page -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            clip-path: polygon(0 0, 100% 0, 100% 70%, 0 100%);
        }

        .login-box {
            position: relative;
            z-index: 1;
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
        }

        .login-title {
            color: rgb(13, 110, 253);
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .btn-login {
            background-color: rgb(25, 135, 84);
            border: none;
        }

        .btn-login:hover {
            background-color: rgb(20, 110, 68);
        }

        .register-link {
            margin-top: 1rem;
            text-align: center;
        }

        .register-link a {
            color: rgb(13, 110, 253);
            text-decoration: none;
        }

        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="bg-shape"></div>

    <div class="login-box m-3">
        <h2 class="login-title">Login to Your Account</h2>
        @if(Session::has('fail'))
        <h5 class="text-danger  text-center mt-1">{{Session::get('fail')}}</h5>
        @endif
        @php
            $jobid = request()->jobid;
        @endphp
        @if($jobid == null)
        <form action="{{ route('post.login') }}" method="POST">
        @else
         <form action="{{ route('post.login',$jobid) }}" method="POST">
        @endif
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" required placeholder="e.g. user@example.com">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required placeholder="••••••••">
            </div>
            <button type="submit" class="btn btn-login w-100">Login</button>
        </form>
        <div class="register-link">
            <p>Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>

</body>
</html>
