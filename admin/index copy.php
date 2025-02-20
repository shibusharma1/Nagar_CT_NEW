<?php
$title = "Admin Dashboard";
require_once '../config/connection.php';
include_once 'master_header.php';
?>

<!-- Login success alert -->
<?php if (isset($_SESSION['login_success'])): ?>
<script>
const Toast = Swal.mixin({
  toast: true,
  position: "top-end",
  showConfirmButton: false,
  timer: 4000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.onmouseenter = Swal.stopTimer;
    toast.onmouseleave = Swal.resumeTimer;
  }
});
Toast.fire({
  icon: "success",
  title: "Signed in successfully"
});
</script>
<?php unset($_SESSION['login_success']); ?>
<?php endif; ?>

<!-- Vote started successfully -->
<?php if (isset($_SESSION['votestart_success'])): ?>
<script>
Toast.fire({
  icon: "success",
  title: "Vote Started successfully"
});
</script>
<?php unset($_SESSION['votestart_success']); ?>
<?php endif; ?>


<!-- Candidate added successfully -->
<?php if (isset($_SESSION['add_candidate'])): ?>
<script>
Toast.fire({
  icon: "success",
  title: "Candidate Added successfully"
});
</script>
<?php unset($_SESSION['add_candidate']); ?>
<?php endif; ?>

<!-- <script>
    // Search candidates in the table
    function searchCandidates() {
        const filter = document.getElementById('searchBar').value.toUpperCase();
        const table = document.getElementById('candidatesTable');
        const tr = table.getElementsByTagName('tr');
        for (let i = 1; i < tr.length; i++) {
            let found = false;
            const td = tr[i].getElementsByTagName('td');
            for (let j = 0; j < td.length; j++) {
                if (td[j] && td[j].innerText.toUpperCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
            tr[i].style.display = found ? '' : 'none';
        }
    }
</script> -->

<div class="table-container">
    <div class="table-title" style="display: flex; align-items: center; justify-content: space-between;">
        <h2 style="flex: 1; text-align: center; margin: 0;">Candidate Lists</h2>
        
        <!-- <?php 
        $sql = "SELECT * FROM vote_status WHERE status = 'T'";
        $sresults = mysqli_query($conn, $sql); 
        $scount = mysqli_num_rows($sresults);
        if ($scount > 0) {
            ?>  
            <form action="endvote.php" method="POST" style="margin-left: auto;">
                <button type="submit" name="endvote" class="delete-button" style="background-color: red; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    End Vote
                </button>
            </form>
            <?php 
        } else {     
            ?>  
            <form action="startvote.php" method="POST" style="margin-left: auto;">
                <button type="submit" name="startvote" class="delete-button" style="background-color: blue; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
                    Start Vote
                </button>
            </form> -->
            <?php 
        } 
        ?>
    </div>

    <!-- Search Bar -->
    <input type="text" id="searchBar" onkeyup="searchCandidates()" placeholder="Search for Candidates..">

    <div class="table-content">
        <table id="candidatesTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>CRN</th>
                    <th>Program</th>
                    <th>Semester</th>
                    <th style="text-align:center;">View</th>
                    <th style="text-align:center;">Action</th>
                </tr>
            </thead>
            <!-- <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                            <td>" . htmlspecialchars($row['Name']) . "</td>
                            <td>" . htmlspecialchars($row['CRN']) . "</td>
                            <td>" . htmlspecialchars($row['programname']) . "</td>
                            <td>" . htmlspecialchars($row['semester']) . "</td>
                            <td>
                                <form method='POST' action='Viewcandidatedetails.php'>
                                    <input type='hidden' name='crn' value='" . htmlspecialchars($row['CRN']) . "'>
                                    <button type='submit' style='border: none; background: none;'>
                                        <i class='fa-sharp fa-regular fa-eye' style='font-size:1.8rem;'></i>
                                    </button>
                                </form>
                            </td>
                            <td>
                                <form method='POST' action='delete.php'>
                                    <input type='hidden' name='crn' value='" . htmlspecialchars($row['CRN']) . "'>
                                    <button type='submit' class='delete-button' style='background-color: red;'>Delete</button>
                                </form>
                            </td> 
                        </tr>";
                    }
                }
                ?>
            </tbody> -->
        </table>
    </div>
</div>

<?php
include_once 'master_footer.php';
?>
