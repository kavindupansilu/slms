<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Lecture Details</title>
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
            var isValid = /^[a-zA-Z]+$/.test(nameInput.value);
            if (!isValid) {
                alert('Name should only contain letters A-Z or a-z.');
                return false;
            }
            return true;
        }

        function validateForm() {
            return validateName();
        }
    </script>
</head>
<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit Lecture Details
                    </h1>
                    <form method="POST" action="{{ route('lecturedetails.update', $lecturedetail->id) }}" class="space-y-4 md:space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="lecturer_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lecturer Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="lecturer_name" name="lecturer_name" pattern="[A-Za-z]+" title="Name should only contain letters A-Z or a-z."  value="{{ $lecturedetail->lecturer_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="degree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="degree" name="degree">
                                <option value="Bachelor Information Technology (Honor)" {{ $lecturedetail->degree == 'Bachelor Information Technology (Honor)' ? 'selected' : '' }}>Bachelor Information Technology (Honor)</option>
                                <option value="Bachelor Business Management (Honor)" {{ $lecturedetail->degree == 'Bachelor Business Management (Honor)' ? 'selected' : '' }}>Bachelor Business Management (Honor)</option>
                                <option value="Bachelor Software Engineer (Honor)" {{ $lecturedetail->degree == 'Bachelor Software Engineer (Honor)' ? 'selected' : '' }}>Bachelor Software Engineer (Honor)</option>
                                <option value="Bachelor Human Resource Management (Honor)" {{ $lecturedetail->degree == 'Human Resource Management (Honor)' ? 'selected' : '' }}>Human Resource Management (Honor)</option>
                            </select>
                        </div>
                        <div>
                            <label for="course_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="course_name" name="course_name" value="{{ $lecturedetail->course_name }}" required>
                        </div>  
                        <div class="mb-3">
                            <label for="batch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Batch</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="batch" name="batch">
                                <option value="Batch 01" {{ $lecturedetail->batch == 'Batch 01' ? 'selected' : '' }}>Batch 01</option>
                                <option value="Batch 02" {{ $lecturedetail->batch == 'Batch 02' ? 'selected' : '' }}>Batch 02</option>
                                <option value="Batch 03" {{ $lecturedetail->batch == 'Batch 03' ? 'selected' : '' }}>Batch 03</option>
                                <option value="Batch 04" {{ $lecturedetail->batch == 'Batch 04' ? 'selected' : '' }}>Batch 04</option>
                            </select>
                        </div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                       <a href="{{ route('lecturedetail') }}" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go Back To Lecture Details Page</a>
                    </form>
                </div>
            </div>
        </div>
    </section> 

</body>
</html>
