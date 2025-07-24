@extends('layouts.app')
@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>Examiner Setup</h2>

        </header>
        <div class="row">
            <div class="col-md-12">
                <section class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class=" col-12">
                                <div class="tabs">
                                    @php
                                        $activeTab = session('active_tab');
                                    @endphp

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 1 || !$activeTab ? 'active' : '' }}" data-bs-target="#ce" href="#ce"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 1 || !$activeTab ? 'true' : 'false' }}" role="tab">
                                                Civil
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 3 ? 'active' : '' }}" data-bs-target="#me" href="#me"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 3 ? 'true' : 'false' }}" role="tab">
                                                Mechanical
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 5 ? 'active' : '' }}" data-bs-target="#te" href="#te"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 5 ? 'true' : 'false' }}" role="tab">
                                                Textile
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 6 ? 'active' : '' }}" data-bs-target="#arch" href="#arch"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 6 ? 'true' : 'false' }}" role="tab">
                                                Architecture
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 2 ? 'active' : '' }}" data-bs-target="#eee" href="#eee"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 2 ? 'true' : 'false' }}" role="tab">
                                                Electrical
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 4 ? 'active' : '' }}" data-bs-target="#cse" href="#cse"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 4 ? 'true' : 'false' }}" role="tab">
                                                Computer
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 9 ? 'active' : '' }}" data-bs-target="#fe" href="#fe"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 9 ? 'true' : 'false' }}" role="tab">
                                                Food
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link {{ $activeTab == 8 ? 'active' : '' }}" data-bs-target="#che" href="#che"
                                               data-bs-toggle="tab" aria-selected="{{ $activeTab == 8 ? 'true' : 'false' }}" role="tab">
                                                Chemical
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content pt-3">
                                        {{-- Civil Engineering (department_id = 1) --}}
                                        <div id="ce" class="tab-pane fade  {{ $activeTab == 1 || !$activeTab ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST"
                                                  action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="1">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 1) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            {{--<td>
                                                                <select
                                                                    name="examiners[{{ $single_question_assign->id }}]"
                                                                    class="form-control populate"
                                                                    data-plugin-selectTwo
                                                                    required>
                                                                    <option value="">Select Examiner</option>
                                                                    @foreach($examiners as $examiner)
                                                                        <option
                                                                            value="{{ $examiner->id }}">{{ $examiner->name }}
                                                                            -{{$examiner->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>--}}
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label for="">Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                               >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="">Part B</label>
                                                                    <select name="examiners_part_b[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                               >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}][]" multiple
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>

                                        {{-- Mechanical Engineering (department_id = 3) --}}
                                        <div id="me" class="tab-pane {{ $activeTab == 3 ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST"
                                                  action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="3">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 3) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            {{--<td>
                                                                <select
                                                                    name="examiners[{{ $single_question_assign->id }}]"
                                                                    class="form-control populate"
                                                                    data-plugin-selectTwo
                                                                    required>
                                                                    <option value="">Select Examiner</option>
                                                                    @foreach($examiners as $examiner)
                                                                        <option
                                                                            value="{{ $examiner->id }}">{{ $examiner->name }}
                                                                            -{{$examiner->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>--}}
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label for="">Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="">Part B</label>
                                                                    <select name="examiners[{{ $single_question_assign->id }}][]" multiple
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                        {{-- Textile Engineering (department_id = 5) --}}
                                        <div id="te" class="tab-pane {{ $activeTab == 5 ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST"
                                                  action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="5">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 5) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            {{--<td>
                                                                <select
                                                                    name="examiners[{{ $single_question_assign->id }}]"
                                                                    class="form-control populate"
                                                                    data-plugin-selectTwo
                                                                    required>
                                                                    <option value="">Select Examiner</option>
                                                                    @foreach($examiners as $examiner)
                                                                        <option
                                                                            value="{{ $examiner->id }}">{{ $examiner->name }}
                                                                            -{{$examiner->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>--}}
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label for="">Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="">Part B</label>
                                                                    <select name="examiners_part_b[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                        {{-- Architecture Engineering (department_id = 6) --}}
                                        <div id="arch" class="tab-pane {{ $activeTab == 6 ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST" action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="6">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 6) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label>Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}">
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label>Part B</label>
                                                                    <select name="examiners_part_b[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}">
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>

                                        {{-- EEE  (department_id = 2) --}}
                                        <div id="eee" class="tab-pane {{ $activeTab == 2 ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST"
                                                  action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="2">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 2) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            {{--<td>
                                                                <select
                                                                    name="examiners[{{ $single_question_assign->id }}]"
                                                                    class="form-control populate"
                                                                    data-plugin-selectTwo
                                                                    required>
                                                                    <option value="">Select Examiner</option>
                                                                    @foreach($examiners as $examiner)
                                                                        <option
                                                                            value="{{ $examiner->id }}">{{ $examiner->name }}
                                                                            -{{$examiner->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>--}}
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label for="">Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="">Part B</label>
                                                                    <select name="examiners_part_b[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                        {{-- CSE  (department_id = 4) --}}
                                        <div id="cse" class="tab-pane {{ $activeTab == 4 ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST"
                                                  action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="4">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 4) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            {{--<td>
                                                                <select
                                                                    name="examiners[{{ $single_question_assign->id }}]"
                                                                    class="form-control populate"
                                                                    data-plugin-selectTwo
                                                                    required>
                                                                    <option value="">Select Examiner</option>
                                                                    @foreach($examiners as $examiner)
                                                                        <option
                                                                            value="{{ $examiner->id }}">{{ $examiner->name }}
                                                                            -{{$examiner->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>--}}
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label for="">Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="">Part B</label>
                                                                    <select name="examiners_part_b[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                        {{-- FE  (department_id = 9) --}}
                                        <div id="fe" class="tab-pane {{ $activeTab == 9 ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST"
                                                  action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="9">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 9) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            {{--<td>
                                                                <select
                                                                    name="examiners[{{ $single_question_assign->id }}]"
                                                                    class="form-control populate"
                                                                    data-plugin-selectTwo
                                                                    required>
                                                                    <option value="">Select Examiner</option>
                                                                    @foreach($examiners as $examiner)
                                                                        <option
                                                                            value="{{ $examiner->id }}">{{ $examiner->name }}
                                                                            -{{$examiner->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>--}}
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label for="">Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="">Part B</label>
                                                                    <select name="examiners_part_b[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                        {{-- Chemical  (department_id = 8) --}}
                                        <div id="che" class="tab-pane {{ $activeTab == 8 ? 'show active' : '' }}" role="tabpanel">
                                            <form method="POST"
                                                  action="{{ route('coordinator.examiner.assign.store') }}">
                                                @csrf
                                                <input type="hidden" name="department_id" value="8">

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th style="width: 10%;">Department</th>
                                                        <th style="width: 10%;">Group</th>
                                                        <th style="width: 10%;">PartType</th>
                                                        <th style="width: 10%;">Question No</th>
                                                        <th style="width: 60%;">Examiner</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($all_question_assigns->where('department_id', 8) as $single_question_assign)
                                                        <tr>
                                                            <td>{{ $single_question_assign->department->short_name ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->group->group ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->partType->type ?? 'N/A' }}</td>
                                                            <td>{{ $single_question_assign->quest_no }}</td>
                                                            {{--<td>
                                                                <select
                                                                    name="examiners[{{ $single_question_assign->id }}]"
                                                                    class="form-control populate"
                                                                    data-plugin-selectTwo
                                                                    required>
                                                                    <option value="">Select Examiner</option>
                                                                    @foreach($examiners as $examiner)
                                                                        <option
                                                                            value="{{ $examiner->id }}">{{ $examiner->name }}
                                                                            -{{$examiner->email}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>--}}
                                                            <td>
                                                                @if ($loop->first)
                                                                    <label for="">Part A</label>
                                                                    <select name="examiners_part_a[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate mb-2"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part A)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                    <label for="">Part B</label>
                                                                    <select name="examiners_part_b[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner (Part B)</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                            >
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @else
                                                                    <select name="examiners[{{ $single_question_assign->id }}]"
                                                                            class="form-control populate"
                                                                            data-plugin-selectTwo
                                                                            required>
                                                                        <option value="">Select Examiner</option>
                                                                        @foreach($examiners as $examiner)
                                                                            <option value="{{ $examiner->id }}"
                                                                                {{ optional($single_question_assign->examiner)->user_id == $examiner->id ? 'selected' : '' }}>
                                                                                {{ $examiner->name }} - {{ $examiner->email }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </section>

            </div>
        </div>
    </section>
@endsection

<script>

</script>
