<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student QR Codes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Student QR Codes</h1>
        <div class="row">
            @foreach($students as $student)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $student->fname }} {{ $student->lname }} <br>{{ $student->degree_name }}</h5>
                            <p class="card-text">Student Id: {{ $student->student_id }}</p>
                            <img src="{{ route('students.qrcode', ['student_id' => $student->student_id]) }}" alt="QR Code">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
