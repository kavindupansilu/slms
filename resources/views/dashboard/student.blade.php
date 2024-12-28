@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('contents')

<div class="container">
    <h1 style="color: blue; font-family: verdana; font-size: 200%;">Student Dashboard</h1>
    <br>
    <div class="add mb-3" style="margin-bottom: 3rem;">
        <a href="{{ route('sregister') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Add Students</a>
        <a href="{{ route('attendance') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Student Attendance</a>
        <a href="{{ route('students.qrcodes') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Students QR</a>
        </div>

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
                    <th style="border: 1px solid; background-color: #6d9eeb; color: black;">Actions</th>
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
                    <td style="border: 1px solid;">
                        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-primary btn-edit">Edit</a>
                        <form action="{{ route('students.destroy', $student->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete" >Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
