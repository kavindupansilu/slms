<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Student Attendance Information</title>
    <link rel="icon" href="logo.png">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <style>
        /* Add custom CSS styles here */
        .container {
            margin-top: 50px;
        }
        .form-control {
            margin-bottom: 15px;
        }
        .btn-submit {
            margin-top: 15px;
        }
    </style>
    <script>
        function validateName() {
            var nameInput = document.getElementById('name');
            var isValid = /^[a-zA-Z\s]+$/.test(nameInput.value);
            if (!isValid) {
                alert('Name should only contain letters A-Z or a-z.');
                return false;
            }
            return true;
        }

        function validateForm() {
            return validateName() ;
        }
    </script>
</head>
<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit Student Attendance Information
                    </h1>
                    <form method="POST" action="{{ route('attendances.update', $attendance->id) }}" class="space-y-4 md:space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="fname" name="fname" pattern="[A-Za-z\s]+" title="Name should only contain letters A-Z or a-z."  value="{{ $attendance->fname }}">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="lname" name="lname" pattern="[A-Za-z\s]+" title="Name should only contain letters A-Z or a-z."  value="{{ $attendance->lname }}">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="date" name="date" min="2024-01-01" max="{{ date('Y-m-d') }}" value="{{ $attendance->date }}">
                        </div>
                        <div class="mb-3">
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time</label>
                            <input type="time" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="time" name="time" value="{{ $attendance->time }}">
                        </div>
                        <div class="mb-3">
                            <label for="degree_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree Name</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="degree_name" name="degree_name">
                                <option value="Bachelor Information Technology (Honor)" {{ $attendance->degree_name == 'Bachelor Information Technology (Honor)' ? 'selected' : '' }}>Bachelor Information Technology (Honor)</option>
                                <option value="Bachelor Business Management (Honor)" {{ $attendance->degree_name == 'Bachelor Business Management (Honor)' ? 'selected' : '' }}>Bachelor Business Management (Honor)</option>
                                <option value="Bachelor Software Engineer (Honor)" {{ $attendance->degree_name == 'Bachelor Software Engineer (Honor)' ? 'selected' : '' }}>Bachelor Software Engineer (Honor)</option>
                                <option value="Bachelor Human Resource Management (Honor)" {{ $attendance->degree_name == 'Human Resource Management (Honor)' ? 'selected' : '' }}>Human Resource Management (Honor)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="batch_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Batch No</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="batch_no" name="batch_no">
                                <option value="Batch 01" {{ $attendance->batch_no == 'Batch 01' ? 'selected' : '' }}>Batch 01</option>
                                <option value="Batch 02" {{ $attendance->batch_no == 'Batch 02' ? 'selected' : '' }}>Batch 02</option>
                                <option value="Batch 03" {{ $attendance->batch_no == 'Batch 03' ? 'selected' : '' }}>Batch 03</option>
                                <option value="Batch 04" {{ $attendance->batch_no == 'Batch 04' ? 'selected' : '' }}>Batch 04</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="status" name="status">
                                <option value="Present" {{ $attendance->status == 'Present' ? 'selected' : '' }}>Present</option>
                                <option value="Absent" {{ $attendance->status == 'Absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                       <a href="{{ route('attendance') }}" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go Back To Attendance Page</a>
                    </form>
                </div>
            </div>
        </div>
    </section> 

</body>
</html>
