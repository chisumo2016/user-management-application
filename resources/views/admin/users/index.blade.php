@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">List All Users</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Roles</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ implode(', ' , $user->roles()->get()->pluck('name')->toArray()) }}</td>
                                    <td>
                                         {{-- permission to view --}}
                                        @can('edit-users')
                                        <a href="{{ route('admin.users.edit',   $user->id) }}"><button type="button" class="btn btn-warning float-left" >Edit</button></a>
                                        @endcan

                                        @can('delete-users')
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="post" class="float-left">
                                            @csrf
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form>
                                         @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
