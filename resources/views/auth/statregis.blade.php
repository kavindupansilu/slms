<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student Attendance</title>
    <link rel="icon" href="logo.png">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
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
            return validateName();
        }

        document.addEventListener('DOMContentLoaded', function() {
            fetchDegrees();

            function fetchDegrees() {
                fetch("{{ route('degrees.all') }}")
                    .then(response => response.json())
                    .then(data => {
                        const degreeSelect = document.getElementById('degree_id');
                        degreeSelect.innerHTML = data.map(degree => `<option value="${degree.id}" data-name="${degree.name}">${degree.name}</option>`).join('');
                    })
                    .catch(error => console.error('Error fetching degrees:', error));
            }
        });

        function updateDegreeInputs() {
            const degreeSelect = document.getElementById('degree_id');
            const selectedDegreeId = degreeSelect.value;
            const selectedDegreeName = degreeSelect.options[degreeSelect.selectedIndex].getAttribute('data-name');
            const degreeNameInput = document.getElementById('degree_name');
            degreeNameInput.value = selectedDegreeName;
        }
    </script>
</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div><br>
                <a href="/">
                    <img src="asset/images/logo.png" class="w-30 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Student Attendance
                    </h1>
                    <form action="{{ route('statregis.save') }}" method="POST" onsubmit="return validateForm()" class="space-y-4 md:space-y-6">
                        @csrf
                        <div>
                            <label for="student_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Student Id</label>
                            <input type="text" name="student_id" id="student_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('student_id')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-wrap">
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                                <input type="text" name="fname" id="fname" pattern="[A-Za-z\s]+" title="Name should only contain letters A-Z or a-z." class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                @error('fname')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="w-full md:w-1/2 px-3">
                                <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                                <input type="text" name="lname" id="lname" pattern="[A-Za-z\s]+" title="Name should only contain letters A-Z or a-z." class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                @error('lname')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                            <input type="date" name="date" id="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"  min="2024-01-01" max="{{ date('Y-m-d') }}" required>
                            @error('date')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="time" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Time</label>
                            <input type="time" name="time" id="time" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('time')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="flex flex-wrap">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label for="degree_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree Name</label>
                                <select name="degree_id" id="degree_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required onchange="updateDegreeInputs()">
                                    <!-- Options will be populated here by JavaScript -->
                                </select>
                                @error('degree_id')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                            <input type="hidden" name="degree_name" id="degree_name">
                            <div class="w-full md:w-1/2 px-3">
                            <label for="batch_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Batch No</label>
                            <select name="batch_no" id="batch_no" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="Batch 01">Batch 01</option>
                                <option value="Batch 01">Batch 02</option>
                                <option value="Batch 01">Batch 03</option>
                                <option value="Batch 01">Batch 04</option>
                            </select>
                            @error('batch_no')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                            </div>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                            <div class="flex items-center mb-4">
                                <input type="radio" name="status" value="Present" id="present" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-4" required>
                                <label for="present" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Present</label>
                                <input type="radio" name="status" value="Absent" id="absent" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 ml-4" required>
                                <label for="absent" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Absent</label>
                            </div>
                            @error('status')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Mark Attendance</button>
                        <h2 class="text-sm font-light text-gray-500 dark:text-gray-400">
                        <a href="{{ route('attendance') }}" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go Back To Attendance Page</a>
                        </h2> 
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
