<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit Student Information</title>
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

        function validatePhone() {
            var phoneInput = document.getElementById('phone_no');
            // var isValid = /^0?7(10|11|12|13|14|15|16|17|18|19)\d{7}$/.test(phoneInput.value);
            var isValid = /^0?7(0|1|2|3|4|5|6|7|8|9)\d{7}$/.test(phoneInput.value);
            if (!isValid) {
                alert('Phone number should start with 070, 071, 072, 073, 074, 075, 076, 077, 078, or 079 followed by 7 digits.');
                return false;
            }
            return true;
        }

        function validateForm() {
            return validateName() && validatePhone();
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

    </script>
</head>
<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit Student Information
                    </h1>
                    <form method="POST" action="{{ route('students.update', $student->id) }}" class="space-y-4 md:space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIC</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="nic" name="nic"  pattern='[7-9][0-9]{8}[Vv]|[2-9][0-9]{11}' title="[7-9][0-9]{8}[Vv]OR[2-9][0-9]{11}" r value="{{ $student->nic }}">
                        </div>
                        <div class="mb-3">
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="fname" name="fname" pattern="[A-Za-z\s]+" title="Name should only contain letters A-Z or a-z."  value="{{ $student->fname }}">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="lname" name="lname" pattern="[A-Za-z\s]+" title="Name should only contain letters A-Z or a-z."  value="{{ $student->lname }}">
                        </div>
                        <div>
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date Of Bith</label>
                            <input type="date" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="dob" name="dob" value="{{ $student->dob }}" required>
                        </div>
                        
                        <div>
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                            <div class="flex items-center mb-4">
                                <input type="radio" name="gender" value="Male" id="male" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 mr-4" {{ $student->gender == 'Male' ? 'checked' : '' }} required>
                                <label for="male" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Male</label>
                                <input type="radio" name="gender" value="Female" id="female" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600 ml-4" {{ $student->gender == 'Female' ? 'checked' : '' }} required>
                                <label for="female" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Female</label>
                            </div>
                            @error('gender')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="email" name="email" value="{{ $student->email }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone No</label>
                            <input type="tel" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="phone_no" name="phone_no" pattern="^0?7(0|1|2|3|4|5|6|7|8|9)\d{7}$" title="Phone number should start with 070, 071, 072, 073, 074, 075, 076, 077, 078, or 079 followed by 7 digits."  value="{{ $student->phone_no }}">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="address" name="address" value="{{ $student->address }}">
                        </div>
                        <div class="mb-3">
                            <label for="degree_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Degree Name</label>
                            <select name="degree_id" id="degree_id" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required onchange="updateDegreeInputs()">
                                <!-- Options will be populated here by JavaScript -->
                            </select>
                            @error('degree_id')
                            <span class="text-red-600">{{ $message }}</span>
                            @enderror
                        </div>
                        <input type="hidden" name="degree_name" id="degree_name">
                        <div class="mb-3">
                            <label for="batch_no" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Batch No</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="batch_no" name="batch_no">
                                <option value="Batch 01" {{ $student->batch_no == 'Batch 01' ? 'selected' : '' }}>Batch 01</option>
                                <option value="Batch 02" {{ $student->batch_no == 'Batch 02' ? 'selected' : '' }}>Batch 02</option>
                                <option value="Batch 03" {{ $student->batch_no == 'Batch 03' ? 'selected' : '' }}>Batch 03</option>
                                <option value="Batch 04" {{ $student->batch_no == 'Batch 04' ? 'selected' : '' }}>Batch 04</option>
                            </select>
                        </div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                       <a href="{{ route('student') }}" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go Back To Student Page</a>
                    </form>
                </div>
            </div>
        </div>
    </section> 

</body>
</html>
