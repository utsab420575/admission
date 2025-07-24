<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>First Part Pass Report</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <!-- Header Section -->
    <h1>First Part Pass Student Report</h1>

    <!-- Print Button -->
    <button onclick="printTable()" class="btn btn-primary mb-3">Print</button>

    <!-- Report Table -->
    <table class="table table-bordered" id="reportTable">
        <thead>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Department</th>
            <th>MCQ English</th>
            <th>Part 1 English</th>
            <th>MCQ Physics</th>
            <th>MCQ Chemistry</th>
            <th>MCQ Math</th>
            <th>MCQ Technical</th>
            <th>Descriptive English</th>
            <th>Descriptive Physics</th>
            <th>Descriptive Chemistry</th>
            <th>Descriptive Math</th>
            <th>Descriptive Technical</th>
            <th>Part 1 Total</th> <!-- New Column for Part 1 Total -->
        </tr>
        </thead>
        <tbody>
        @foreach($marks as $mark)
            <tr>
                <td>{{ $mark->student->studentid }}</td>
                <td>{{ $mark->student->name }}</td>
                <td>{{ $mark->department->name }}</td>
                <td>{{ $mark->mcq_eng }}</td>
                <td>{{ $mark->part_1_eng }}</td>
                <td>{{ $mark->mcq_phy }}</td>
                <td>{{ $mark->mcq_chem }}</td>
                <td>{{ $mark->mcq_math }}</td>
                <td>{{ $mark->mcq_tech }}</td>
                <td>{{ $mark->part_1_eng }}</td>
                <td>{{ $mark->part_1_phy }}</td>
                <td>{{ $mark->part_1_chem }}</td>
                <td>{{ $mark->part_1_math }}</td>
                <td>{{ $mark->part_2_tech }}</td>
                <td>{{ $mark->p1_total }}</td> <!-- Displaying Part 1 Total -->
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<!-- Add Bootstrap JS and jQuery (needed for Bootstrap functionality) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Print Functionality -->
<script>
    function printTable() {
        var printContent = document.getElementById('reportTable').outerHTML;
        var headerContent = '<h1>First Part Pass Student Report</h1>'; // Include the header in the print content

        var win = window.open('', '', 'height=800, width=800');
        win.document.write('<html><head><title>Print Report</title>');
        win.document.write('<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">');
        win.document.write('</head><body>');
        win.document.write(headerContent); // Add header content to the print page
        win.document.write(printContent); // Add table content to the print page
        win.document.write('</body></html>');
        win.document.close();
        win.print();
    }
</script>
</body>
</html>
