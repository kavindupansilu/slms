@extends('layouts.lecdisplay')

@section('title', 'Student Dashboard')

@section('contents')

<div class="container">
    <h1 style="color: blue; font-family: verdana; font-size: 200%;">Student Dashboard</h1>
    <br>
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h2 style="font-size: 20px;">Students Details</h2>
        <br>
        <table class="table table-striped" style="border: 1px solid; width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="border: 2px solid; padding: 8px;">
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">ID</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Student ID</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">NIC</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Name</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Gender</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">DOB</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Phone No</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Address</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Email</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Degree</th>
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Batch</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($students as $student)
                <tr>
                    <td style="border: 1px solid;">{{ $student->id }}</td>
                    <td style="border: 1px solid;">{{ $student->student_id }}</td>
                    <td style="border: 1px solid;">{{ $student->nic }}</td>
                    <td style="border: 1px solid;">{{ $student->fname }} {{ $student->lname }}</td>
                    <td style="border: 1px solid;">{{ $student->gender }}</td>
                    <td style="border: 1px solid;">{{ $student->dob }}</td>
                    <td style="border: 1px solid;">{{ $student->phone_no }}</td>
                    <td style="border: 1px solid;">{{ $student->address }}</td>
                    <td style="border: 1px solid;">{{ $student->email }}</td>
                    <td style="border: 1px solid;">{{ $student->degree_name }}</td>
                    <td style="border: 1px solid;">{{ $student->batch_no }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
