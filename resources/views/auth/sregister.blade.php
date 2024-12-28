<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Student Register</title>
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

        function validatePhone() {
            var phoneInput = document.getElementById('phone_no');
            var isValid = /^0?7(0|1|2|3|4|5|6|7|8|9)\d{7}$/.test(phoneInput.value);
            if (!isValid) {
                alert('Phone number should start with 070, 071, 072, 073, 074, 075, 076, 077, 078, or 079 followed by 7 digits.');
                return false;
            }
            return true;
        }

        function validateDOB() {
            var dobInput = document.getElementById('dob').value;
            var selectedDate = new Date(dobInput);
            var currentDate = new Date();
            var minAgeDate = new Date(currentDate.getFullYear() - 15, currentDate.getMonth(), currentDate.getDate());
            var minSelectableDate = new Date(1990, 0, 1); // January 1, 1990

            if (selectedDate > currentDate) {
                alert('Date of birth cannot be a future date.');
                return false;
            }
            
            if (selectedDate > minAgeDate) {
                alert('Date of birth must be at least 15 years ago from the current date.');
                return false;
            }

            if (selectedDate < minSelectableDate) {
                alert('Please select a date of birth from 1990 onwards.');
                return false;
            }

            return true;
        }


        function validateForm() {
            return validateName() && validatePhone() && validateDOB();
        }

                //degree's name, and degree ID will be automatically populated
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
                        Student Register
                    </h1>
                    <form action="{{ route('sregister.save') }}" method="POST" onsubmit="return validateForm()" class="space-y-4 md:space-y-6">
                        @csrf
                        <div>
                            <label for="nic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIC</label>
                            <input type="text" name="nic" id="nic"  pattern='[7-9][0-9]{8}[Vv]|[2-9][0-9]{11}' title="[7-9][0-9]{8}[Vv]OR[2-9][0-9]{11}" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('nic')
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
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of Birth</label>
                            <input type="date" name="dob" id="dob" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" min="1990-01-01" max="{{ date('Y-m-d') }}" required>
                            @error('dob')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                            <div class="flex items-center mb-4">
                                <input type="radio" name="gender" value="Male" id="male" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-4" required>
                                <label for="male" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                                <input type="radio" name="gender" value="Female" id="female" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 ml-4" required>
                                <label for="female" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                            </div>
                            @error('gender')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('email')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" name="address" id="address" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('address')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                            <input type="tel" name="phone_no" id="phone_no" pattern="0?7(0|1|2|3|4|5|6|7|8|9)\d{7}" title="Phone number should start with 070, 071, 072, 073, 074, 075, 076, 077, 078, or 079 followed by 7 digits." class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                            @error('phone_no')
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
                                    <option value="Batch 02">Batch 02</option>
                                    <option value="Batch 03">Batch 03</option>
                                    <option value="Batch 04">Batch 04</option>
                                </select>
                                @error('batch_no')
                                <span class="text-red-600">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Create an account</button>
                        <h2 class="text-sm font-light text-gray-500 dark:text-gray-400">
                            <a href="{{ route('student') }}" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go Back To Student Page</a>
                        </h2>
                    </form>
            </div>
        </div>
    </section>
</body>

</html>
