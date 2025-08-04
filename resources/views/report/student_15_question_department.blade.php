<!DOCTYPE html>
<html>
<head>
    <title>Question Missing Report</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #000;
            margin: 20px;
        }

        h3.title-main {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 4px;
        }

        h4.subtitle {
            font-size: 16px;
            font-weight: normal;
            margin: 6px 4px;
        }

        h3.section-heading {
            font-size: 17px;
            margin-top: 16px;
            margin-bottom: 8px;
            text-decoration: underline;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
            padding: 6px;
            border: 1px solid #000;
            font-weight: bold;
        }

        td {
            border: 1px solid #000;
            padding: 6px;
            vertical-align: top;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        td:last-child {
            font-size: 11px;
        }
    </style>
</head>
<body>
<div>
    <div style="text-align: center;">
        <h3 class="title-main">Dhaka University of Engineering & Technology, Gazipur</h3>
        <h4 class="subtitle">Undergraduate Admission Test 2024-2025</h4>
        <h4 class="subtitle">11-12 August 2025</h4>
        <h4 class="subtitle">Department of {{ $department->name }}</h4>
        <h3 class="section-heading">List of Candidates with Missing Questions</h3>
    </div>

    <table>
        <thead>
        <tr>
            <th>SL</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Missing Page</th>
            <th>Missing Page Details</th>
        </tr>
        </thead>
        <tbody>
        @foreach($students as $index => $student)
            @php
                $missingPages = $student->missingPageDesigns($totalPageDesigns);
                $formatPageInfo = function ($pageIds) {
                    return collect($pageIds)->map(function($id) {
                        $page = \App\Models\PageDesign::with(['group', 'partType'])->find($id);
                        if (!$page) return "ID:$id";
                        $group = optional($page->group)->group ?? 'N/A';
                        $type = optional($page->partType)->type ?? 'N/A';
                        return "Page-{$page->page_no}  Question-{$page->quest_no} {$type} {$group}";
                    })->implode('<br>');
                };
            @endphp

            @if($student->hasIncompletePages($totalPageDesigns))
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->studentid }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ count($missingPages) }}</td>
                    <td>{!! $formatPageInfo($missingPages) ?: 'None' !!}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
