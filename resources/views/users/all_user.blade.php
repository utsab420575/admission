@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <section role="main" class="content-body">
        <header class="page-header">
            <h2>All Teachers</h2>
            <div class="right-wrapper text-end">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li><span>Pages</span></li>
                    <li><span>All Teachers</span></li>
                </ol>
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="row">
            <div class="col-md-12">
                <section class="card">
                    <div class="card-body">
                        <table class="table table-bordered table-striped mb-0" id="datatable-default">
                            <thead>
                            <tr>
                                <th>SL No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @foreach($user->roles ?? [] as $role)
                                            <span class="badge bg-danger">{{ $role->name }}</span>
                                        @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        &nbsp;
                                        <a href="{{ route('user.delete', $user->id) }}" class="btn btn-sm btn-danger delete">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
    </section>
@endsection
