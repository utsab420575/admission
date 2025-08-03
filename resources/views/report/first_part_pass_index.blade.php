@extends('layouts.app')

@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>First Part(Mcq+Descriptive) Pass Report</h2>
            <div class="right-wrapper text-end">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li><span>Report</span></li>
                    <li class="pe-3"><span>First Part(English MCQ + Descriptive) Pass</span></li>
                </ol>
            </div>
        </header>

        <div class="row">
            <div class="col-md-10">
                <section class="card">
                    <div class="card-body">
                        <table class="table table-hover table-striped">
                            <thead>
                            <tr>
                                <th>SL</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($departments as $index => $department)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $department->name }}</td>
                                    <td>
                                        <a href="{{ route('report.english.mcq.pass.department', $department->id) }}"
                                           class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i> View Report (First Part)
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">No departments found.</td>
                                </tr>
                            @endforelse
                            <tr>
                                <td>{{ $departments->count() + 1 }}</td>
                                <td><strong>All Departments</strong></td>
                                <td>
                                    {{-- for showing all department--}}
                                    <a href="{{ route('report.english.mcq.pass.department',0) }}" class="btn btn-sm btn-dark">
                                        <i class="fas fa-list"></i> View All
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>

    </section>
@endsection
