<?php
session_start();
?>
<?php
include($_SERVER['DOCUMENT_ROOT'] . "/resources/config.php");
include($_SERVER['DOCUMENT_ROOT'] . "/resources/ChromePhp.php");

//include '../../resources/config.php';
//include '../../resources/ChromePhp.php';
require_once('../../resources/templates/nurseheader.php');

//ChromePhp::log($_SESSION['myusername']);
//ChromePhp::log($_SESSION['role']);
if (!isset($_SESSION['myusername']) || $_SESSION['role'] != "nurse") {
  header("location:../../login.php");
}

$roomQuery = "SELECT count(*) FROM Room_Assignedto WHERE carecardnum is NULL;";
$result = $conn->query($roomQuery);
$roomRow = $result->fetch_assoc();

$allRooms = "SELECT count(*) FROM Room_Assignedto;";

$allRoomResult = $conn->query($allRooms);
$allRoomRow = $allRoomResult->fetch_assoc();
?>


<html>
    <body>
    <h3>Available Rooms:</h3>
    <h2><?php echo $roomRow['count(*)']
    . " / " . $allRoomRow['count(*)']; ?></h2>

    </body>
</html>

<?php
  echo "<br/>";
  require_once("../../resources/templates/footer.php");
?>
