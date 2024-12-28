@extends('layouts.app')

@section('title', 'Course Dashboard')

@section('contents')

<div class="container">
@if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    <h1 style="color: blue; font-family: verdana; font-size: 200%;">Course Dashboard</h1>
    <br>
    <div class="add mb-3" style="margin-bottom: 3rem;">
        <a href="{{ route('coursereg') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Add Course Module</a>
        </div>

    <div class="container">
        <h2 style="font-size: 20px;">Course Details </h2><br>        
        <a href="{{ route('degree') }}" class="btn btn-primary" style="border: 2px solid #00BFFF; color: black; padding: 5px 10px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Back</a>
        <br><br>
        <table class="table table-striped" style="border: 1px solid;  width: 100%;border-collapse: collapse;">
            <thead>
                <tr style="border: 2px solid; padding: 8px;">
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">ID</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Course Code</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Course Name</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Credit</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Year</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Semester</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Degree Name</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Lecturer Name</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                <tr >
                    <td style="border: 1px solid;">{{ $course->id }}</td>
                    <td style="border: 1px solid;">{{ $course->ccode }}</td>
                    <td style="border: 1px solid;">{{ $course->cname }}</td>
                    <td style="border: 1px solid;">{{ $course->credit }}</td>
                    <td style="border: 1px solid;">{{ $course->year }}</td>
                    <td style="border: 1px solid;">{{ $course->semster }}</td>
                    <td style="border: 1px solid;">{{ $course->degree_name }}</td>
                    <td style="border: 1px solid;">{{ $course->fname }} {{ $course->lname }}</td>
                    <td style="border: 1px solid;">
                    <a href="{{ route('course.edit', $course->id) }}" class="btn btn-primary btn-edit" >Edit</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display: inline;">
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
