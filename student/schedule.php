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

    <title>Student | Schedule</title>
</head>
<body>

    <?php
        if (isset($_POST["sNumVal"])) {
            $studentNum = $_POST['sNumVal'];
        } elseif (isset($_POST['changeDay'])) {
            $studentNum = $_POST['studentNumVal'];
        } else {
            header("location: ../index.html");
        }
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
            <<button onclick = "home()" class="sidebar-button" href="home.php" title="Go to Home Page">
                <p>HOME</p>
            </button>
            <button onclick = "info()" class ="sidebar-button" href="info.php" title="Go to Info Page">
                <p>INFO</p>
            </button>
            <button onclick = "schedule()" class ="sidebar-button" href="schedule.php" title="Go to Schedule Page" style ="background-color: #606060;">
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
                <p style = "width: 80%; text-align: center;">S T U D E N T&nbsp;&nbsp;&nbsp;S C H E D U L E</p>
            </div>
            <div class="main-area-content-box" style="row-gap: 3%; padding-top: 2.5%; padding-bottom: 2%;">
                
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="sched-form" class="select-box-button-container">
                    <select name="day" id="schedule" class="select-box">
                        <option value="none">CHOOSE DAY</option>
                        <option value="1">MONDAY</option>
                        <option value="2">TUESDAY</option>
                        <option value="3">WEDNESDAY</option>
                        <option value="4">THURSDAY</option>
                        <option value="5">FRIDAY</option>
                        <option value="6">SATURDAY</option>
                    </select>
                    <input type="hidden" name="studentNumVal" value="<?php echo $studentNum; ?>">
                    <input type="submit" name="changeDay" id="schedule-button" value="S H O W"/>
                </form>

                <div class="schedule-container">
                    <div class = "schedule-row">
                        <div class = "schedule-row-data">S U B J E C T</div>
                        <div class = "schedule-row-data">S T A R T</div>
                        <div class = "schedule-row-data">E N D</div>
                        <div class = "schedule-row-data">R O O M</div>
                    </div>

                <?php
                    if (isset($_POST['changeDay'])) {
                        $day = $_POST['day'];

                        $sql = "SELECT `subject`, `start`, `end`, `room` FROM schedule WHERE course = (SELECT course FROM student WHERE studentNum = ?) AND section = (SELECT section FROM student WHERE studentNum = ?) AND day = ? ORDER BY `start`";

                        $stmt = $con->prepare($sql);
                        $stmt->bind_param("iii", $studentNum, $studentNum, $day);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        while ($row = $result->fetch_assoc()) {
                            ?>
                                <div class = "schedule-row">
                                    <div class = "schedule-row-data"><?php echo $row['subject']; ?></div>
                                    <div class = "schedule-row-data"><?php echo $row['start']; ?></div>
                                    <div class = "schedule-row-data"><?php echo $row['end']; ?></div>
                                    <div class = "schedule-row-data"><?php echo $row['room']; ?></div>
                                </div>
                            <?php
                        }
                    }
                ?>
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