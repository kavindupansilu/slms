<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Course Module</title>
    <link rel="icon" href="logo.png">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js"></script>
    <script>
    function validateCName() {
        var cnameInput = document.getElementById('cname');
        var isValid = /^[a-zA-Z\s]+$/.test(cnameInput.value);
        if (!isValid) {
            alert('Course Name should only contain letters A-Z, a-z, and spaces.');
            return false;
        }
        return true;
    }

    function validateForm() {
        return validateCName();
    }

    // Degree's name, and degree ID will be automatically populated
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

    // Lecturer's first name, last name, and user ID will be automatically populated
    document.addEventListener('DOMContentLoaded', function() {
        fetchLecturers();

        function fetchLecturers() {
            fetch("{{ route('users.all') }}")
                .then(response => response.json())
                .then(data => {
                    const userSelect = document.getElementById('user_id');
                    userSelect.innerHTML = data.map(user => `<option value="${user.id}" data-fname="${user.fname}" data-lname="${user.lname}">${user.fname} ${user.lname}</option>`).join('');
                })
                .catch(error => console.error('Error fetching lecturers:', error));
        }
    });

    function updateUserInputs() {
        const userSelect = document.getElementById('user_id');
        const selectedUserId = userSelect.value;
        const selectedUserFname = userSelect.options[userSelect.selectedIndex].getAttribute('data-fname');
        const selectedUserLname = userSelect.options[userSelect.selectedIndex].getAttribute('data-lname');
        document.getElementById('fname').value = selectedUserFname;
        document.getElementById('lname').value = selectedUserLname;
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
                    Course Module
                    </h1>
                    <form action="{{ route('coursereg.save') }}" method="POST" onsubmit="return validateForm()" class="space-y-4 md:space-y-6">
                        @csrf
                        <div>
                            <label for="cname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Course Name</label>
                            <input type="text" name="cname" id="cname" pattern="[A-Za-z\s]+" title="Course Name should only contain letters A-Z or a-z."  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('cname')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="credit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Credit</label>
                            <select name="credit" id="credit" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="1"> 1</option>
                                <option value="2"> 2</option>
                                <option value="3"> 3</option>
                                <option value="4"> 4</option>
                            </select>                           
                             @error('credit')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="year" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Year</label>
                            <select name="year" id="year" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="Year 1">Year 1</option>
                                <option value="Year 2">Year 2</option>
                                <option value="Year 3">Year 3</option>
                                <option value="Year 4">Year 4</option>
                            </select>
                            @error('year')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="semster" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semster</label>
                            <select name="semster" id="semster" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                <option value="Semster 1">Semster 1</option>
                                <option value="Semster 2">Semster 2</option>
                            </select>
                            @error('semster')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
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

                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Lecturer Name</label>
                            <select name="user_id" id="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required onchange="updateUserInputs()">
                                <!-- Options will be populated here by JavaScript -->
                            </select>
                            @error('user_id')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="fname" id="fname">
                        <input type="hidden" name="lname" id="lname">
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create New</button>
                        <h2 class="text-sm font-light text-gray-500 dark:text-gray-400">
                            <a href="{{ route('degree') }}" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go Back To Degree Page</a>
                        </h2>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
