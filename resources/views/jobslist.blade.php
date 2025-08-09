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
        color: #4627E6; 
        background: #A7F3D0; 
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
        background-color: #00C897;
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
  
.search-button {
    background: #00C897;
    border: 2px solid grey;
    border-left: none;
    border-radius: 0 15px 15px 0;
    padding: 0 15px;
    color: white;
    cursor: pointer;
}
.search-button:hover {
    background: #00a87c;
}


</style>


</head>
<body>

    <div class="wrapper">
    

<div class="row">
<main class="bg-secondary bg-light min-vh-100 py-4 px-3">
<div class="container mt-4">
     <!-- Back Button -->
    <div class="mb-3">
        <a href="{{ route('index') }}" style="text-decoration: none" class="text-secondary" >
            <i class="fa fa-arrow-left"></i>
        </a>
    </div>
    <h3 class="text-center text-secondary">Find Your Dream Job Here</h3>

    <!-- Search Bar -->
   
    <div class="row mb-4">
       <center>
        <div class="col-sm-8">
              <form action="" method="post" class="mt-3">
                  @csrf
                  <div class="input-group">
                      <input type="text" name="searchinput" class="search-input form-control" placeholder="Search by category"
                          required autocomplete="on" style="border: 2px solid grey;border-right: none;border-radius: 15px 0 0 15px;outline: none;height: 41px;padding-left: 10px;">
                      <button class="search-button" type="submit">
                          <i class="fa fa-search" aria-hidden="true"></i>
                      </button>
                  </div>
              </form>
          </div>
          </center>
    </div>
    <center>
   <div class="col-sm-8">
    <div class="d-flex flex-wrap gap-2">
        @foreach ($categories as $category)
            <a href="{{ route('jobseeker.viewAllJobs', ['category_id' => $category->id]) }}" 
               class="btn btn-secondary">
                {{ $category->name }}
            </a>
        @endforeach
    </div>
</div>

</center>

    <!-- Job Listings -->
    <div class="row g-4 mt-3">
        @forelse($jobs as $job)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card shadow h-100">
                    <div class="card-body">
                        <h5 class="card-title text-success">{{ $job->title }}</h5>
                        <p class="mb-1"><strong>Salary:</strong> {{ number_format($job->salary) }} TZS</p>
                        <p class="mb-1"><strong>Location:</strong> 
                            {{ $job->jobAddress->city ?? '' }}, {{ $job->jobAddress->country ?? '' }}
                        </p>
                        <p class="small text-muted"><strong>Posted:</strong> {{ $job->created_at->format('d-m-Y') }}</p>

                        <hr>

                        <!-- Shortened summary -->
                        <p>
                            {{ \Illuminate\Support\Str::limit(strip_tags($job->description), 80, '...') }}
                        </p>
                         @if($job->pdf_path)
                <p><strong>Full Job Description:</strong></p>
                <a href="{{ asset('storage/' . $job->pdf_path) }}" class="btn btn-outline-primary mb-2" target="_blank">
                    📄 View Full Description
                </a>
            @endif
                        <a href="{{ route('login',$job->id) }}" class="btn btn-success btn-sm">
                            Apply Now
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <h5 class="text-center text-danger">No Jobs Found</h5>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $jobs->links('pagination::bootstrap-5') }}
    </div>

</div>
</main>
</div>
  
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>