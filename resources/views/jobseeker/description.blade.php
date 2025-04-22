@extends('layouts.master')

@section('title', 'Job Description')

@section('content')
<div class="container mt-5 mb-5">
    <div class="bg-white p-4 shadow-sm rounded">

        <!-- Company and Title -->
        <div class="mb-4">
            <h4 class="text-muted">Treasure Data</h4>
            <h2 class="fw-bold">Technical Support Engineer</h2>
            <p class="text-muted">Tokyo • Partial Remote • Full-time • April 14, 2025</p>
        <!-- Apply Now Button -->
<a href="#" class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#applyModal">
    APPLY NOW
</a>

        </div>

        <!-- Conditions & Requirements -->
        <div class="row text-center border-top pt-4 mt-4">
            <div class="col-md-4">
                <h6 class="text-uppercase text-secondary">Conditions</h6>
                <p><strong>Apply from:</strong> <span class="text-danger">Tanzania Only</span></p>
                <p><strong>No relocation</strong> to Tanzania</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-uppercase text-secondary">Requirements</h6>
                <p><strong>swahili:</strong> Business Level</p>
                <p><strong>English:</strong> Business Level</p>
            </div>
            <div class="col-md-4">
                <h6 class="text-uppercase text-secondary">Minimum Experience</h6>
                <p>Mid-level or above</p>
            </div>
        </div>

        <!-- Job Description -->
        <div class="mt-5">
            <h4 class="fw-bold">What You’ll Do</h4>
            <ul>
                <li>Provide technical support to enterprise customers around the globe.</li>
                <li>Troubleshoot complex data pipeline and integration issues.</li>
                <li>Collaborate closely with engineering teams to resolve customer concerns.</li>
                <li>Document solutions and build knowledge base articles.</li>
                <li>Support clients via email, chat, and video calls.</li>
                <li>Monitor and ensure SLA compliance and customer satisfaction.</li>
            </ul>
        </div>

        <!-- Background & Skills -->
        <div class="mt-4">
            <h4 class="fw-bold">Background & Skills</h4>
            <ul>
                <li>3+ years of technical support or software engineering experience.</li>
                <li>Experience with cloud platforms like AWS, GCP, or Azure.</li>
                <li>Strong understanding of APIs, SQL, and data integration.</li>
                <li>Excellent communication and problem-solving skills.</li>
                <li>Fluency in both English and Japanese (Business Level).</li>
            </ul>
        </div>

        <!-- Physical Requirements -->
        <div class="mt-4">
            <h4 class="fw-bold">Physical Requirements</h4>
            <ul>
                <li>Ability to work remotely from within Japan.</li>
                <li>Occasional travel to Tokyo HQ (if required).</li>
                <li>Must be comfortable using virtual meeting tools daily.</li>
            </ul>
        </div>

        <!-- Perks & Benefits -->
        <div class="mt-4">
            <h4 class="fw-bold">Perks & Benefits</h4>
            <ul>
                <li>Flexible working hours and remote-first culture.</li>
                <li>Health insurance, pension, and commuter benefits.</li>
                <li>Annual learning & development budget.</li>
                <li>Generous paid time off and national holidays.</li>
            </ul>
        </div>

        <!-- Company Mission -->
        <div class="mt-4">
            <h4 class="fw-bold">Our Mission</h4>
            <p>
                At Treasure Data, we believe in unlocking the power of data to empower businesses worldwide.
                Our goal is to build tools that help teams make smarter, data-driven decisions every day.
            </p>
        </div>

        <!-- Team Culture -->
        <div class="mt-4">
            <h4 class="fw-bold">Our Team Culture</h4>
            <p>
                We’re a distributed team that thrives on collaboration and inclusivity. We value curiosity,
                continuous improvement, and celebrating wins—big or small.
            </p>
        </div>

        <!-- Learning & Growth -->
        <div class="mt-4">
            <h4 class="fw-bold">Learning & Growth</h4>
            <p>
                You’ll receive dedicated mentorship, regular feedback, and career growth plans.
                We also support certifications, online courses, and tech conference attendance.
            </p>
        </div>

        <!-- How to Apply -->
        <div class="mt-4">
            <h4 class="fw-bold">How to Apply</h4>
            <p>
                Interested candidates currently residing in Japan can apply via the link above.
                For inquiries, please contact us at <strong>boardsearch.tz</strong>.
            </p>
        </div>

    </div>
</div>


<!-- Application Modal -->
<div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content p-4">
      <div class="modal-header">
        <h5 class="modal-title" id="applyModalLabel">Apply Now</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <form>
          <div class="row mb-3">
            <div class="col">
              <label for="firstName" class="form-label">First name</label>
              <input type="text" class="form-control" id="firstName" placeholder="Enter your first name">
            </div>
            <div class="col">
              <label for="lastName" class="form-label">Last name</label>
              <input type="text" class="form-control" id="lastName" placeholder="Enter your last name">
            </div>
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="Enter your email">
          </div>

          <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" placeholder="+255...">
          </div>

          <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn profile URL</label>
            <input type="url" class="form-control" id="linkedin" placeholder="https://linkedin.com/in/yourname">
          </div>

          <div class="mb-3">
            <label for="resume" class="form-label">Upload your resume</label>
            <input class="form-control" type="file" id="resume" accept=".pdf">
          </div>

          <div class="text-end">
            <button type="submit" class="btn btn-primary">Submit Application</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

@endsection
