@extends('layouts.app')

@section('title', 'Student Attendance Dashboard')

@section('contents')
<div class="container">
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<h1 style="color: blue; font-family: verdana; font-size: 200%;">Student Attendance Dashboard</h1>
<br>
<div class="add mb-3" style="margin-bottom: 3rem;">
    <a href="{{ route('dashboard.scan') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Add Student Attendance</a>
    <a href="{{ route('statregis') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Student Attendance</a>
    <a href="{{ route('student') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Back To Student</a>
</div>

<!-- Filter Form -->
<form method="GET" action="{{ route('attendances.index') }}">
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="date" name="date" class="form-control" placeholder="Date" min="2024-01-01" max="{{ date('Y-m-d') }}">
        </div>
        <div class="col-md-3">
            <select name="batch" id="batch" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="Batch 01">Batch 01</option>
                <option value="Batch 02">Batch 02</option>
                <option value="Batch 03">Batch 03</option>
                <option value="Batch 04">Batch 04</option>
            </select>
            @error('batch')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-3">
            <select name="degree" id="degree" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                <option value="Bachelor Information Technology (Honor)">Bachelor Information Technology (Honor)</option>
                <option value="Bachelor Business Management (Honor)">Bachelor Business Management</option>
                <option value="Bachelor Software Engineer (Honor)">Software Engineer (Honor)</option>
                <option value="Bachelor Human Resource Management (Honor)">Bachelor Human Resource Management (Honor)</option>
            </select>
            @error('degree')
            <span class="text-red-600">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-primary">Filter</button>
        </div>
    </div>
</form>

<!-- Print Button -->
<div class="text-right mb-3">
    <button onclick="printTable()" class="btn btn-secondary">Print</button>
</div>

<div class="container">
    <div id="printableTable">
        <h2>Students Attendance Details</h2>
        <table class="table table-striped" style="border: 1px solid; width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border: 2px solid; padding: 8px;">
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">ID</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Student ID</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Name</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Date</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Time</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Degree</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Batch</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Status</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;" class="action-column">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendances as $attendance)
                <tr>
                    <td style="border: 1px solid;">{{ $attendance->id }}</td>
                    <td style="border: 1px solid;">{{ $attendance->student_id }}</td>
                    <td style="border: 1px solid;">{{ $attendance->fname }} {{ $attendance->lname }}</td>
                    <td style="border: 1px solid;">{{ $attendance->date }}</td>
                    <td style="border: 1px solid;">{{ $attendance->time }}</td>
                    <td style="border: 1px solid;">{{ $attendance->degree_name }}</td>
                    <td style="border: 1px solid;">{{ $attendance->batch_no }}</td>
                    <td style="border: 1px solid;">{{ $attendance->status }}</td>
                    <td style="border: 1px solid;" class="action-column">
                        <a href="{{ route('attendance.edit', $attendance->id) }}" class="btn btn-primary btn-edit">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

<script>
    function printTable() {
        var printContents = document.getElementById('printableTable').innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>
@endsection
