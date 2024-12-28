@extends('layouts.app')

@section('title', 'Degree Dashboard')

@section('contents')

<div class="container">
@if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
    <h1 style="color: blue; font-family: verdana; font-size: 200%;">Degree Dashboard</h1>
    <br>
    <div class="add mb-3" style="margin-bottom: 3rem;">
        <a href="{{ route('degregister') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Add Degree</a>
        <a href="{{ route('coursereg') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">Add Course Module</a>
    </div>

    <div class="container">
        <h2 style="font-size: 20px;">Degree Details</h2>
        <br>
        <br>

        <table class="table table-striped" style="border: 1px solid;  width: 100%;border-collapse: collapse;">
            <thead>
                <tr style="border: 2px solid; padding: 8px;">
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">ID</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Degree ID</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Name</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Title</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Duration</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($degrees as $degree)
                <tr>
                    <td style="border: 1px solid;">{{ $degree->id }}</td>
                    <td style="border: 1px solid;">{{ $degree->degree_id }}</td>
                    <td style="border: 1px solid;">{{ $degree->name }}</td>
                    <td style="border: 1px solid;">{{ $degree->title }}</td>
                    <td style="border: 1px solid;">{{ $degree->duration }}</td>
                    <td style="border: 1px solid;">
                        <a href="{{ route('dashboard.course', ['degree_id' => $degree->id]) }}" class="btn btn-success btn-edit">View</a>
                        <a href="{{ route('degree.edit', $degree->id) }}" class="btn btn-primary btn-edit">Edit</a>
                        <form action="{{ route('degrees.destroy', $degree->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
