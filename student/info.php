<?php
    include "../pages/login/dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/student.css"> <!-- css link -->

    <!-- font links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter&display=swap">

    <!-- icon things (ty realfavicongenerator) -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title>Student | Info</title>
</head>
<body>

    <?php
        if (isset($_POST["sNumVal"])) {
            $studentNum = $_POST['sNumVal'];
        } else {
            header("location: ../index.html");
        }

        $sql = "SELECT * FROM `student` WHERE studentNum = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $studentNum);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    ?>

    <form id = "sendNumHome" action="home.php" method = "post">
        <input type="hidden" name = "sNumVal" value = <?php echo $studentNum; ?>>
    </form>

    <form id = "sendNumInfo" action="info.php" method = "post">
        <input type="hidden" name = "sNumVal" value = <?php echo $studentNum; ?>>
    </form>

    <form id = "sendNumSchedule" action="schedule.php" method = "post">
        <input type="hidden" name = "sNumVal" value = <?php echo $studentNum; ?>>
    </form>

    <form id = "sendNumGrades" action="grades.php" method = "post">
        <input type="hidden" name = "sNumVal" value = <?php echo $studentNum; ?>>
    </form>

    <div class ="page">

        <div class="border-accent">
            <p>&nbsp;</p> <!-- filler so div shows -->
        </div>

        <div class ="sidebar">
            <a class = "logo" href="../index.html" title="Go to Home Page">
                <img src="../resources/logo/tsu.jpg" alt="TSU Logo" id ="circle" style="margin-bottom: 4%;">
                <p style="margin-top: 8%;">Thomas State University</p>
            </a>
            <button onclick = "home()" class="sidebar-button" href="home.php" title="Go to Home Page">
                <p>HOME</p>
            </button>
            <button onclick = "info()" class ="sidebar-button" href="info.php" title="Go to Info Page" style="background-color: #606060;">
                <p>INFO</p>
            </button>
            <button onclick = "schedule()" class ="sidebar-button" href="schedule.php" title="Go to Schedule Page">
                <p>SCHEDULE</p>
            </button>
            <button onclick = "grades()" class ="sidebar-button" href="grades.php" title="Go to Grades Page">
                <p>GRADES</p>
            </button>
            <div class = "sidebar-button">
                <p>Copyright 2023, TCCP.<br>All rights reserved.</p>
            </div>
        </div>

        <div class="main-area">
            <div class = "main-area-header">
                <p style = "width: 80%; text-align: center;">S T U D E N T&nbsp;&nbsp;&nbsp;I N F O</p>
            </div>
            <div class="main-area-content-box">
                <div class="full-info-container">
                    <p class="full-info-question">NAME:</p> <p class="full-info-answer"><?php echo $row['name']; ?></p>
                    <p class="full-info-question">COURSE:</p> <p class="full-info-answer"><?php echo $row['course']; ?></p>
                    <p class="full-info-question">SECTION:</p> <p class="full-info-answer"><?php echo $row['section']; ?></p>
                    <p class="full-info-question">ADDRESS:</p> <p class="full-info-answer"><?php echo $row['address']; ?></p>
                    <p class="full-info-question">BIRTHDAY:</p> <p class="full-info-answer"><?php echo $row['birthday']; ?></p>
                    <p class="full-info-question">AGE:</p> <p class="full-info-answer"><?php echo $row['age']; ?></p>
                    <p class="full-info-question">STUDENT #:</p> <p class="full-info-answer"><?php echo $row['studentNum']; ?></p>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    function home() {
        const studentNumForm = document.getElementById("sendNumHome");
        studentNumForm.submit();
    }

    function info() {
        const studentNumForm = document.getElementById("sendNumInfo");
        studentNumForm.submit();
    }

    function schedule() {
        const studentNumForm = document.getElementById("sendNumSchedule");
        studentNumForm.submit();
    }

    function grades() {
        const studentNumForm = document.getElementById("sendNumGrades");
        studentNumForm.submit();
    }
</script>
</html>