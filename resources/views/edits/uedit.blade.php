<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Edit User Information</title>
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
    </script>
</head>
<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    Edit User Information
                    </h1>
                    <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4 md:space-y-6">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nic" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">NIC</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="nic" name="nic" value="{{ $user->nic }}">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="role" name="role">
                            <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                                <option value="Lecturer" {{ $user->role == 'Lecturer' ? 'selected' : '' }}>Lecturer</option>
                                <option value="Coordinator" {{ $user->role == 'Coordinator' ? 'selected' : '' }}>Coordinator</option>
                                <option value="Student" {{ $user->role == 'Student' ? 'selected' : '' }}>Student</option>
                                <option value="Visiting Lecturer" {{ $user->role == 'Visiting Lecturer' ? 'selected' : '' }}>Visiting Lecturer</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                            <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="title" name="title">
                                <option value="Mr" {{ $user->title == 'Mr' ? 'selected' : '' }}>Mr</option>
                                <option value="Ms" {{ $user->title == 'Ms' ? 'selected' : '' }}>Ms</option>
                                <option value="Miss" {{ $user->title == 'Miss' ? 'selected' : '' }}>Miss</option>
                                <option value="Dr" {{ $user->title == 'Dr' ? 'selected' : '' }}>Dr</option>
                                <option value="Prof" {{ $user->title == 'Prof' ? 'selected' : '' }}>Prof</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="fname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="fname" name="fname" pattern="[A-Za-z]+" title="Name should only contain letters A-Z or a-z."  value="{{ $user->fname }}">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                            <input type="text" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="lname" name="lname" pattern="[A-Za-z]+" title="Name should only contain letters A-Z or a-z."  value="{{ $user->lname }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone</label>
                            <input type="tel" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="phone" name="phone" pattern="^0?7(0|1|2|3|4|5|6|7|8|9)\d{7}$" title="Phone number should start with 070, 071, 072, 073, 074, 075, 076, 077, 078, or 079 followed by 7 digits."  value="{{ $user->phone}}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" id="email" name="email" value="{{ $user->email }}">
                        </div>
                        
                        
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                       <a href="{{ route('user') }}" class="flex w-full justify-center rounded-md bg-blue-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-blue-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-600">Go Back To User Page</a>
                    </form>
                </div>
            </div>
        </div>
    </section> 

</body>
</html>
