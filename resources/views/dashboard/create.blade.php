<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Add Student</h2>
        <form method="POST" action="{{ route('students.store') }}">
            @csrf

            <div class="mb-3">
                <label for="index_no" class="form-label">Index No</label>
                <input type="text" class="form-control" id="index_no" name="index_no" required>
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="phone_no" class="form-label">Phone No</label>
                <input type="text" class="form-control" id="phone_no" name="phone_no" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="degree_name" class="form-label">Degree Name</label>
                <select class="form-select" id="degree_name" name="degree_name" required>
                    <option value="">Select Degree</option>
                    <option value="Bachelor Information Technology (Honor)">Bachelor Information Technology (Honor)</option>
                    <option value="Bachelor Business Management (Honor)">Bachelor Business Management (Honor)</option>
                    <option value="Bachelor Software Engineer (Honor)">Bachelor Software Engineer (Honor)</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="batch_no" class="form-label">Batch No</label>
                <select class="form-select" id="batch_no" name="batch_no" required>
                    <option value="">Select Batch</option>
                    <option value="1st batch">1st batch</option>
                    <option value="2nd batch">2nd batch</option>
                    <option value="3rd batch">3rd batch</option>
                    <option value="4th batch">4th batch</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Add Student</button>
            <a href="{{ route('students.index') }}" class="btn btn-secondary">Cancel</a>
            <a href="{{ route('students.index') }}" class="btn btn-warning">Student List</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
