<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


    <style>
    /* Hero Section Styling */
    .hero-section {
        background: #f9f9f9;
        padding: 40px 0; /* Adjusted padding */
        min-height: 80vh; /* Full screen height */
        display: flex;
        align-items: center; /* Vertically center content */
        height:100vh;
        overflow: visible; /* or remove overflow if not necessary */
    }

    /* Row Flexbox Fix */
    .hero-section .row {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}

    /* Left Side: Text Content */
    .text-content h1 {
        font-weight: bold;
        font-size: 42px;
        padding-bottom: 0.5rem;
        line-height: 1.5; /* or try 1.4 */
    }

    .highlight {
        color: #002366; 
        background: #ffd700; 
        padding: 5px 10px;
        border-radius: 5px;
    }

    .subtitle {
        font-size: 18px;
        color: #666;
        max-width: 550px;
        margin-top: 15px;
    }

    .buttons {
        margin-top: 20px;
    }

    .buttons .btn {
        font-size: 16px;
        padding: 12px 20px;
        margin: 10px 5px;
    }

    .btn-success {
        background-color: #ffd700;
        border: none;
    }

    .btn-dark {
        background-color: #1D1B29;
        color: #fff;
    }

    /* Right Side: Image */
  /* Hero Image */
.hero-image {
    max-width: 60%; /* Increase width */
    height: auto; /* Maintain aspect ratio */
    border-radius: 10px;
    max-height: 500px; /* Increase max height */
}
    /* Responsive Fixes */

/* Responsive Fixes */
@media (max-width: 768px) {
    .hero-section {
        text-align: center;
    }
    .hero-section .row {
        flex-direction: column;
    }
    .text-content {
        margin-bottom: 30px;
    }
    .hero-image {
        max-width: 80%; /* Make image bigger on smaller screens */
        max-height: 20%;
    }
    }
</style>


</head>
<body>

    <div class="wrapper">
        @include('layouts.header')

        <div class="container content mt-4">
            @yield('content')
        </div>

        @include('layouts.footer')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<style>
.footer {
    background-color: #0D0C1D; /* Dark background like in the image */
    color: white; /* Text color */
    padding: 50px 20px;
    text-align: center;
}

/* Footer Links */
.footer a {
    color: white;
    text-decoration: none;
    margin: 0 10px;
    font-size: 16px;
}

.footer a:hover {
    text-decoration: underline;
}

/* Footer Sections */
.footer .quick-links, 
.footer .contact-info, 
.footer .social-media {
    margin-bottom: 20px;
}

/* Social Media Icons */
.footer .social-media a {
    font-size: 20px;
    margin: 0 10px;
}

/* Copyright and Legal */
.footer .legal {
    font-size: 14px;
    opacity: 0.8;
    margin-top: 20px;
}

/* Cookie Banner */
.cookie-banner {
    background: #1A1A2E; /* Dark theme */
    color: white;
    padding: 10px 20px;
    position: fixed;
    bottom: 0;
    width: 100%;
    text-align: center;
    z-index: 999;
}

.cookie-banner button {
    background: #00D4A7; /* Green accent */
    color: white;
    border: none;
    padding: 10px 20px;
    margin-left: 10px;
    cursor: pointer;
    border-radius: 5px;
}

.cookie-banner button:hover {
    background: #00B893;
}
</style>
</html>
