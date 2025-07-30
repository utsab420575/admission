@extends('layouts.app')

@section('content')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Add Teacher</h2>

            <div class="right-wrapper text-end">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li><span>Teacher</span></li>
                    <li><span>Add Teacher</span></li>
                </ol>
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.store') }}" class="p-3">
                            @csrf
                            <h4 class="mb-3 font-weight-semibold text-dark">Teacher Information</h4>

                            <div class="row mb-3">
                                <div class="form-group col">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Enter Name" value="{{ old('name') }}" required>
                                    @error('name')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group col">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="Enter Email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group pb-3">
                                <label for="roles" class="form-label">
                                    Assign Roles <span class="text-danger">*</span>
                                </label>

                                <div class="input-group input-group-select-append">
                                    <span class="input-group-text">
                                        <i class="fas fa-th-list"></i>
                                    </span>
                                    <select name="roles[]" id="roles" class="form-control" multiple data-plugin-multiselect required>
                                        @foreach($roles as $role)
                                            <option
                                                value="{{ $role->name }}">
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('roles')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>



                            <div class="row">
                                <div class="col text-end mt-3">
                                    <button type="submit" class="btn btn-primary">Add User</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
