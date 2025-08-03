@extends('layouts.app')

<style>
    @media print {
        body, table, th, td {
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 11px;
            color: #000 !important;
        }

        .btn, .breadcrumbs, .page-header {
            display: none !important;
        }

        table, th, td {
            border: 1px solid #000 !important;
            border-collapse: collapse !important;
            padding: 4px;
        }

        table {
            width: 100%;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }
    }
</style>

@section('content')
    <section role="main" class="content-body">
        <header class="page-header">
            <h2>MCQ English Pass Report</h2>
            <div class="right-wrapper text-end">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li><span>Report</span></li>
                    <li class="pe-3"><span>MCQ English Pass</span></li>
                </ol>
            </div>
        </header>

        {{-- Print Button --}}
        <div class="row mb-3">
            <div class="col text-end">
                <button class="btn btn-primary" onclick="printReport()">🖨️ Print Report</button>
            </div>
        </div>

        <div id="print-area">
            {{-- DUET Header --}}
            <div class="row">
                <div class="col text-center mb-3">
                    <h3 style="margin-top: -5px;">Dhaka University of Engineering & Technology, Gazipur</h3>
                    <h4 style="margin-top: -10px;">Undergraduate Admission Test 2024-2025</h4>
                    <h4 style="margin-top: -10px;">11-12 August 2025</h4>
                    <h4 style="margin-top: 5px;">MCQ English Passed Students</h4>
                </div>
            </div>

            {{-- Report Table --}}

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>SL</th>
                    <th>Student ID</th>
                    <th>Student Name</th>
                    <th>Department</th>
                    <th>MCQ English</th>
                    <th>Part 1 English</th>
                </tr>
                </thead>
                <tbody>
                @php $sl = 1; @endphp
                @foreach($marks as $mark)
                    @if($mark->mcq_eng >= 3)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $mark->student->studentid }}</td>
                            <td>{{ $mark->student->name }}</td>
                            <td>{{ $mark->department->name }}</td>
                            <td class="text-success fw-bold">{{ $mark->mcq_eng }}</td>
                            <td>{{ $mark->part_1_eng }}</td>
                        </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- Print Script --}}
    @push('scripts')
        <script>
            function printReport() {
                var content = document.getElementById('print-area').innerHTML;
                var original = document.body.innerHTML;

                document.body.innerHTML = content;
                window.print();
                document.body.innerHTML = original;
                location.reload();
            }
        </script>
    @endpush
@endsection
