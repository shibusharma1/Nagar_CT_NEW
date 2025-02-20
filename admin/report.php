<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../assets/result_background.png" type="image/x-icon" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voting Reports</title>
    <!-- <link rel="stylesheet" href="../styles.css"> -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 10px;
            padding: 20px;
            color: #343a40;
        }

        h1 {
            text-align: center;
            color: #024699;
            margin-bottom: 40px;
        }

        h2 {
            color: #343a40;
            /* border-bottom: 2px solid #007bff; */
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #6c757d;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }

        table,
        th,
        td {
            border: 1px solid #dee2e6;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #024699;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #d9e2f3;
        }

        #downloadBtn {
            display: block;
            float: right;
            width: 200px;
            margin: 0 auto 20px;
            padding: 10px;
            background-color: #024699;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        .logo-img{
            margin: 0;
            padding: 0;
            text-align: center;
        }
    </style>
</head>

<body>

    <a id="downloadBtn">Download Report as PDF</a>
    
     
        <div>
    <div id="reportContent" style="margin:0px 5rem;">
        <?php
        include_once '../config/createdb.php';
        include_once '../config/connection.php';


        $sql = "SELECT * from votes";
        $result = mysqli_query($conn, $sql);
        $row1 = mysqli_fetch_assoc($result);
        //  $voted=$row1['count(*)'];
        



        // Assuming you have start and end time for voting process
        
        $vote_start_time = $row1['created_at']; // Replace with actual start time
        
        ?>
        <div class="logo-img">
        <img src='../assets/logo.png' alt='logo'     style="padding-left: 230px;">
        <h1>Voting Reports</h1>
        </div>
        <?php 
        echo "";
        echo "<p>Voting started at: $vote_start_time</p>";
        // echo "<p>Voting ended at: $vote_end_time</p>";
        
        // Total Voters (Students eligible to vote)
        $sql = "SELECT COUNT(*) AS total_voters FROM registerstudent";
        $result = $conn->query($sql);
        $total_voters = $result->fetch_assoc()['total_voters'];
        echo "<h2>Total Voters: $total_voters</h2>";

        // Total Voted Students
        $sql = "SELECT COUNT(DISTINCT student_id) AS voted_students FROM votes";
        $result = $conn->query($sql);
        $voted_students = $result->fetch_assoc()['voted_students'];
        echo "<h2>Voted Students: $voted_students</h2>";

        // Pending Students (Students who haven't voted)
        $pending_students = $total_voters - $voted_students;
        echo "<h2>Pending Students: $pending_students</h2>";

        // Percentage Calculation Helper Function
        function calculatePercentage($part, $whole)
        {
            return $whole == 0 ? 0 : round(($part / $whole) * 100, 2);
        }

        // Percentage of Voters by Program
        $sql = "SELECT p.programname, COUNT(DISTINCT v.student_id) AS voted_count,
            (SELECT COUNT(*) FROM registerstudent WHERE programid = p.programid) AS total_count
            FROM programs p
            LEFT JOIN registerstudent rs ON p.programid = rs.programid
            LEFT JOIN votes v ON rs.student_id = v.student_id
            GROUP BY p.programid";
        $result = $conn->query($sql);

        echo "<h2>Percentage of Voters by Program</h2>";
        echo "<table>
    <tr>
        <th>Program</th>
        <th>Total Students</th>
        <th>Voted Students</th>
        <th>Voting Percentage</th>
    </tr>";
        while ($row = $result->fetch_assoc()) {
            $percentage = calculatePercentage($row['voted_count'], $row['total_count']);
            echo "<tr>
                <td>{$row['programname']}</td>
                <td>{$row['total_count']}</td>
                <td>{$row['voted_count']}</td>
                <td>{$percentage}%</td>";
        }
        echo "</table><br>";

        // Percentage of Voters by Semester
        $sql = "SELECT rs.semester, COUNT(DISTINCT v.student_id) AS voted_count,
            (SELECT COUNT(*) FROM registerstudent WHERE semester = rs.semester) AS total_count
            FROM registerstudent rs
            LEFT JOIN votes v ON rs.student_id = v.student_id
            GROUP BY rs.semester";
        $result = $conn->query($sql);

        echo "<h2>Percentage of Voters by Semester</h2>";
        echo "<table>
    <tr>
        <th>Semester</th>
        <th>Total Students</th>
        <th>Voted Students</th>
        <th>Voting Percentage</th>
    </tr>";
        while ($row = $result->fetch_assoc()) {
            $percentage = calculatePercentage($row['voted_count'], $row['total_count']);
            echo "<tr>
                <td>{$row['semester']}</td>
                <td>{$row['total_count']}</td>
                <td>{$row['voted_count']}</td>
                <td>{$percentage}%</td>";
        }
        echo "</table><br>";

        // Percentage of Voters by Program & Semester including Top Candidate
$sql = "SELECT p.programname, rs.semester, COUNT(DISTINCT v.student_id) AS voted_count,
(SELECT COUNT(*) FROM registerstudent WHERE programid = p.programid AND semester = rs.semester) AS total_count,
c.Name, COUNT(v.vote_id) AS candidate_votes
FROM programs p
LEFT JOIN registerstudent rs ON p.programid = rs.programid
LEFT JOIN votes v ON rs.student_id = v.student_id
LEFT JOIN candidates c ON v.candidate_id = c.candidate_id
WHERE rs.programid = p.programid AND rs.semester = rs.semester
GROUP BY p.programname, rs.semester, c.candidate_id
ORDER BY candidate_votes DESC";

$result = $conn->query($sql);

echo "<h2>Percentage of Voters by Program & Semester with Top Candidate</h2>";
echo "<table>
<tr>
<th>Program</th>
<th>Semester</th>
<th>Total Students</th>
<th>Voted Students</th>
<th>Voting Percentage</th>
<th>Top Candidate</th>
<th>Top Candidate Votes</th>
</tr>";

$currentProgramSemester = '';  // To track program and semester for grouping
while ($row = $result->fetch_assoc()) {
$percentage = calculatePercentage($row['voted_count'], $row['total_count']);

// Ensure only the first row for each program and semester is displayed
if ($row['programname'] . $row['semester'] != $currentProgramSemester) {
$currentProgramSemester = $row['programname'] . $row['semester'];

echo "<tr>
    <td>{$row['programname']}</td>
    <td>{$row['semester']}</td>
    <td>{$row['total_count']}</td>
    <td>{$row['voted_count']}</td>
    <td>{$percentage}%</td>
    <td>{$row['Name']}</td>
    <td>{$row['candidate_votes']}</td>
</tr>";
}
}
echo "</table><br>";


// Close the connection
$conn->close();
?>
    <!-- Include html2canvas and jsPDF from CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
<script>
    document.getElementById('downloadBtn').addEventListener('click', function () {
        html2canvas(document.getElementById('reportContent')).then(function (canvas) {
            const imgData = canvas.toDataURL('image/png');
            const doc = new jsPDF('p', 'mm', 'a4');

            const imgWidth = 190;  // Width of the image in the PDF (with margin)
            const pageHeight = 295; // A4 page height
            const margin = 10;  // Margin from the edges
            const padding = 5;  // Padding inside the content area
            const imgHeight = canvas.height * imgWidth / canvas.width;
            let heightLeft = imgHeight;
            let position = margin + padding;

            // Add watermark
            const watermarkText = "";
            const watermarkFontSize = 40;
            const watermarkX = 105;  // X position for center alignment
            const watermarkY = 150;  // Y position for center alignment
            const watermarkAngle = 45;  // Angle of the watermark text

            doc.addImage(imgData, 'PNG', margin + padding, position, imgWidth - 2 * padding, imgHeight - 2 * padding);
            heightLeft -= pageHeight;

            // Watermark on the first page
            doc.setTextColor(150, 150, 150);  // Gray color for watermark
            doc.setFontSize(watermarkFontSize);
            doc.text(watermarkText, watermarkX, watermarkY, null, null, 'center');
            doc.setTextColor(0, 0, 0);  // Reset text color to black

            // Add more pages if content overflows
            while (heightLeft >= 0) {
                position = heightLeft - imgHeight;
                doc.addPage();
                doc.addImage(imgData, 'PNG', margin + padding, position, imgWidth - 2 * padding, imgHeight - 2 * padding);
                heightLeft -= pageHeight;

                // Watermark on each subsequent page
                doc.setTextColor(150, 150, 150);  // Gray color for watermark
                doc.setFontSize(watermarkFontSize);
                doc.text(watermarkText, watermarkX, watermarkY, null, null, 'center');
                doc.setTextColor(0, 0, 0);  // Reset text color to black
            }

            doc.save('Voting_Report.pdf');
        });
    });
</script>


</body>

</html>