@extends('layouts.app')

@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Edit Teacher</h2>

            <div class="right-wrapper text-end">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li><span>User</span></li>
                    <li><span>Edit User</span></li>
                </ol>
                <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
            </div>
        </header>

        <div class="row">
            <div class="col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('user.update') }}" class="p-3">
                            @csrf
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <h4 class="mb-3 font-weight-semibold text-dark">User Information</h4>

                            <div class="row mb-3">
                                <div class="form-group col">
                                    <label for="name">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{ old('name', $user->name) }}" required>
                                    @error('name')
                                    <span class="text-danger"> {{ $message }} </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="form-group col">
                                    <label for="email">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           value="{{ old('email', $user->email) }}" required>
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
                                            <option value="{{ $role->name }}"
                                                {{ in_array($role->name, old('roles', $user->getRoleNames()->toArray())) ? 'selected' : '' }}>
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
                                    <button type="submit" class="btn btn-primary">Update User</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
