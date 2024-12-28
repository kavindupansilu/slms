@extends('layouts.lecdisplay')

@section('title', 'Student Attendance Dashboard')

@section('contents')

<div class="container">
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif
<h1 style="color: blue; font-family: verdana; font-size: 200%;">Student Attendance Dashboard</h1>
<br>

<!-- Filter Form -->
<form method="GET" action="{{ route('disattendance') }}">
    <div class="row mb-3">
        <div class="col-md-3">
            <input type="date" name="date" class="form-control" placeholder="Date">
        </div>
        <div class="col-md-3">
            <input type="text" name="batch" class="form-control" placeholder="Batch">
        </div>
        <div class="col-md-3">
            <input type="text" name="degree" class="form-control" placeholder="Degree">
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
    <h2 style="font-size: 20px;">Students Attendance Details</h2>
    <br><br>
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
