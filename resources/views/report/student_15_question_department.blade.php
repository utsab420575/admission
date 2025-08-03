@extends('layouts.app')
<style>
    @media print {


        /* Ensure ALL text uses Times New Roman */
        body, table, th, td {
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 11px;
            color: #000;!important;
        }


        /* Hide UI elements */
        .btn, .breadcrumbs, .page-header {
            display: none !important;
        }

        /* Table styling */
        table, th, td {
            font-family: 'Times New Roman', Times, serif;
            font-size: 11px;
            border: 1px solid #000 !important;
            border-collapse: collapse !important;
            padding: 4px;
            border-collapse: collapse;
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
            <h2>Question Missing Report</h2>
            <div class="right-wrapper text-end">
                <ol class="breadcrumbs">
                    <li>
                        <a href="{{ route('dashboard') }}">
                            <i class="bx bx-home-alt"></i>
                        </a>
                    </li>
                    <li><span>Report</span></li>
                    <li class="pe-3"><span>Question Missing</span></li>
                </ol>
            </div>
        </header>

        {{-- Print Button --}}
        <div class="row mb-3">
            <div class="col text-end">
                <button class="btn btn-primary" onclick="printReport()">🖨️ Print Report</button>
            </div>
        </div>

        {{-- Report Section --}}
        <div id="print-area">
            <div class="row">
                <div class="col text-center">
                    <div>
                        <h3 style="margin-top: -5px;">Dhaka University of Engineering & Technology, Gazipur</h3>
                        <h4 style="margin-top: -10px;">Undergraduate Admission Test 2024-2025</h4>
                        <h4 style="margin-top: -10px;">11-12 August 2025</h4>
                        <h4 style="margin-top: -10px;">Department of {{ $department->name }}</h4>
                        <h3 style="margin-top: 0px;">List of all candidates paper missing/extra</h3>
                    </div>
                </div>
            </div>

            {{-- Table --}}
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Missing Question Count</th>
                            <th>Missing Page Details</th>
                            <th>Extra Page Entered</th>
                            <th>Duplicate Page Entered</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($students as $index => $student)
                            @php
                                $missingPages = $student->missingPageDesigns($totalPageDesigns);
                                $extraPages = $student->extraPageDesigns($totalPageDesigns);
                                $duplicatePages = $student->duplicatePageDesigns();

                                $formatPageInfo = function ($pageIds) {
                                    return collect($pageIds)->map(function($id) {
                                        $page = \App\Models\PageDesign::with(['group', 'partType'])->find($id);
                                        if (!$page) return "ID:$id";
                                        $group = optional($page->group)->group ?? 'N/A';
                                        $type = optional($page->partType)->type ?? 'N/A';
                                        return "P{$page->page_no}-Q{$page->quest_no}-{$type}-G{$group}";
                                    })->implode('<br>');
                                };
                            @endphp

                            @if($student->hasIncompletePages($totalPageDesigns) || count($extraPages) > 0 || count($duplicatePages) > 0)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $student->studentid }}</td>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ count($missingPages) }}</td>
                                    <td>{!! $formatPageInfo($missingPages) ?: '<span class="text-muted">None</span>' !!}</td>
                                    <td>{!! $formatPageInfo($extraPages) ?: '<span class="text-muted">None</span>' !!}</td>
                                    <td>{!! $formatPageInfo($duplicatePages) ?: '<span class="text-muted">None</span>' !!}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
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
                location.reload(); // Optional: Refresh to re-apply JS bindings
            }
        </script>
    @endpush
@endsection
