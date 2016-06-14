<?php
session_start();

include '../../resources/ChromePhp.php';
include '../../resources/config.php';

if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "doctor") {
    header("location:../../login.php");
}
?>
<?php
//include($_SERVER["DOCUMENT_ROOT"] . "/resources/config.php");
// include($_SERVER["DOCUMENT_ROOT"] . "/resources/ChromePhp.php");
//require_once($_SERVER["DOCUMENT_ROOT"] ."/resources/templates/doctorheader.php");
// ChromePhp::log('Hello console!');
// ChromePhp::warn('something went wrong!');

$myEID = $_SESSION['mypassword'];
$patientQuery = "SELECT * FROM Patient_Attendedby WHERE eid = '$myEID'";
$patientResult = $conn->query($patientQuery);

$data = array();

while($row = $patientResult->fetch_assoc()) {
    $data[] = $row;
}

$colNames = array_keys(reset($data));

// query for all patients
$allPatientsQuery = "SELECT * FROM Patient_Attendedby";
$allResult = $conn->query($allPatientsQuery);

$allData = array();
while($allRow = $allResult->fetch_assoc()) {
    $allData[] = $allRow;
}

?>

<h3>My Patients</h3>
<table class="table table-hover">
    <tr>
        <?php
           // print the header
           foreach($colNames as $colName) {
              echo "<th> $colName </th>";
           }
        ?>
    </tr>
    <?php
        // print the rows
        foreach($data as $row) {
            echo "<tr>";
            foreach($colNames as $colName) {
                echo "<td>".ucfirst($row[$colName])."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>

<a class="btn btn-success" href="delete_patient.php">Remove Patient</a>
<a class="btn btn-success" href="delete_prescrption.php">Delete Prescrption</a>
<a class="btn btn-success" href="delete_medicalRecord.php">Delete Medical Record</a>


<h3>All Patients</h3>
<table class="table table-hover">
    <tr>
        <?php
           // print the header
           foreach($colNames as $colName) {
              echo "<th> $colName </th>";
           }
        ?>
    </tr>
    <?php
        // print the rows
        foreach($allData as $allRow) {
            echo "<tr>";
            foreach($colNames as $colName) {
                echo "<td>".ucfirst($allRow[$colName])."</td>";
            }
            echo "</tr>";
        }
    ?>
</table>

<?php
    require_once("../../resources/templates/footer.php");
?>