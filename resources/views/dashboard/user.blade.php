@extends('layouts.app')

@section('title', 'User Dashboard')

@section('contents')

<div class="container">
    <h1 style="color: blue; font-family: verdana; font-size: 200%;">User Dashboard</h1>
    <br>
    <div class="add mb-3" style="margin-bottom: 3rem;">
        <a href="{{ route('register') }}" class="btn btn-primary" style="background-color: #1656AD; color: white; padding: 10px 32px; box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">New User</a>
    </div>

    <div class="container">
    @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <h2 style="font-size: 20px;">User Details</h2>
        <br>
        <table class="table table-striped" style="border: 1px solid;  width: 100%;border-collapse: collapse;">
            <thead>
                <tr style="border: 2px solid; padding: 8px;">
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">ID</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">User ID</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Role</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">NIC</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Title</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Name</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Phone No</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Email</th>
                    <th style="border: 1px solid;background-color: #6d9eeb; color: black;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr >
                    <td style="border: 1px solid;">{{ $user->id }}</td>
                    <td style="border: 1px solid;">{{ $user->user_id }}</td>
                    <td style="border: 1px solid;">{{ $user->role }}</td>
                    <td style="border: 1px solid;">{{ $user->nic }}</td>
                    <td style="border: 1px solid;">{{ $user->title }}</td>
                    <td style="border: 1px solid;">{{ $user->fname}} {{$user->lname }}</td>
                    <td style="border: 1px solid;">{{ $user->phone }}</td>
                    <td style="border: 1px solid;">{{ $user->email }}</td>
                    <td style="border: 1px solid;">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-primary btn-edit">Edit</a>
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-delete">Delete</button>
                    </form>
                </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
