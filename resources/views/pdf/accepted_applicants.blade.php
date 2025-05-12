<!DOCTYPE html>
<html>
<head>
    <title>Accepted Applicants</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Accepted Applicants for "{{ $job->title }}"</h2>
    <p>Occupation: {{ $job->occupation->name ?? 'N/A' }}</p>

    <table>
        <thead>
            <tr>
                <th>S/N</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>c
                <th>Gender</th>
                <th>Age</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
            @foreach($acceptedApplicants as $index => $app)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $app->applicant->name }}</td>
                <td>{{ $app->applicant->email }}</td>
                <td>{{ $app->applicant->employeeMoreDetails->phone ?? 'N/A' }}</td>
                <td>{{ $app->applicant->employeeMoreDetails->gender ?? 'N/A' }}</td>
                <td>{{ $app->applicant->employeeMoreDetails->age ?? 'N/A' }}</td>
                <td>{{ $app->applicant->employeeMoreDetails->region ?? 'N/A' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
