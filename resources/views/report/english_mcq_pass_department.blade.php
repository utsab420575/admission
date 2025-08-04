<!DOCTYPE html>
<html>
<head>
    <title>MCQ English Pass Report</title>
    <style>
        body, table, th, td {
            font-family: 'Times New Roman', Times, serif !important;
            font-size: 12px;
            color: #000 !important;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: center;
        }

        h3, h4 {
            margin: 0;
            padding: 4px 0;
        }

        @media print {
            @page {
                size: A4;
                margin: 1cm;
            }
        }
    </style>
</head>
<body>

<div style="text-align: center;">
    <img width="50" height="50" src="{{asset('images/logo/duet-logo.png')}}">
    <h3>Dhaka University of Engineering & Technology, Gazipur</h3>
    <h4>Undergraduate Admission Test 2024-2025</h4>
    <h4>{{ \Carbon\Carbon::now()->format('d F Y') }}</h4>
    <h4>List of Students Passed in MCQ English</h4>
</div>

<table>
    <thead>
    <tr>
        <th>SL</th>
        <th>Department</th>
        <th>MCQ English Mark</th>
       {{-- <th>Part 1 English</th>--}}
    </tr>
    </thead>
    <tbody>
    @php $sl = 1; @endphp
    @foreach($marks as $mark)
        @if($mark->mcq_eng >= 3)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $mark->department->name }}</td>
                <td><strong>{{ $mark->mcq_eng }}</strong></td>
                {{--<td>{{ $mark->part_1_eng }}</td>--}}
            </tr>
        @endif
    @endforeach

    @php $sl = 1; @endphp
    @foreach($marks as $mark)
        @if($mark->mcq_eng >= 3)
            <tr>
                <td>{{ $sl++ }}</td>
                <td>{{ $mark->department->name }}</td>
                <td><strong>{{ $mark->mcq_eng }}</strong></td>
                {{--<td>{{ $mark->part_1_eng }}</td>--}}
            </tr>
        @endif
    @endforeach
    </tbody>
</table>

</body>
</html>
