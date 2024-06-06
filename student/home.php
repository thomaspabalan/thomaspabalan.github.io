<?php
    include '../pages/login/dbcon.php';
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

    <title>Student | Home</title>
</head>
<body>
    
    <?php
        if (isset($_POST["sNumVal"])) {
            $studentNum = $_POST['sNumVal'];
        } else {
            header("location: ../index.html");
        }

        $sql = "SELECT `name`, `course`, `section`, `studentNum`, (SELECT AVG(final) FROM `grades` WHERE studentNum = ?) AS GWA FROM `student` WHERE studentNum = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("ii", $studentNum, $studentNum);
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
            <button onclick = "home()" class="sidebar-button" href="home.php" title="Go to Home Page" style="background-color: #606060;">
                <p>HOME</p>
            </button>
            <button onclick = "info()" class ="sidebar-button" href="info.php" title="Go to Info Page">
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
                <p style = "width: 80%; text-align: center;">S T U D E N T&nbsp;&nbsp;&nbsp;H O M E</p>
            </div>
            <div class="main-area-content-box">
                
                <div class="id-picture"></div>
                <div class="main-info-container">
                    NAME:
                    <br>
                    <?php echo $row['name']; ?>
                    <br>
                    COURSE:
                    <br>
                    <?php echo $row['course']; ?>
                    <br>
                    SECTION:
                    <br>
                    <?php echo $row['section']; ?>
                    <br>
                    STUDENT NUMBER:
                    <br>
                    <?php echo $row['studentNum']; ?>
                </div>
                <div class="gwa-container">
                    <p style="padding-right: 0.5%;">CUMULATIVE GWA: </p>
                    <p style="padding-right: 0.1%;"><?php echo $row['GWA']; ?></p>
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