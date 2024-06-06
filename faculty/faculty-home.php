<?php
    include '../pages/login/dbcon.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/faculty.css"> <!-- css link -->

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

    <title>Faculty | Home</title>
</head>
<body>
    
    <?php
        if (isset($_POST["emailVal"])) {
            $email = $_POST['emailVal'];
        } else {
            header("location: ../index.html");
        }

        $sql = "SELECT `name`, `occupation`, `address`, `facultyEmail`, `salary` FROM `faculty` WHERE facultyEmail = ?";

        $stmt = $con->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    ?>

    <form id = "sendEmailHome" action="faculty-home.php" method = "post">
        <input type="hidden" name = "emailVal" value = <?php echo $email; ?>>
    </form>

    <form id = "sendEmailInfo" action="faculty-info.php" method = "post">
        <input type="hidden" name = "emailVal" value = <?php echo $email; ?>>
    </form>

    <form id = "sendEmailSchedule" action="faculty-schedule.php" method = "post">
        <input type="hidden" name = "emailVal" value = <?php echo $email; ?>>
    </form>

    <form id = "sendEmailAdmin" action="faculty-admin.php" method = "post">
        <input type="hidden" name = "emailVal" value = <?php echo $email; ?>>
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
            <button onclick = "home()" class="sidebar-button" href="faculty-home.php" title="Go to Home Page" style="background-color: #606060;">
                <p>HOME</p>
            </button>
            <button onclick = "info()" class ="sidebar-button" href="faculty-info.php" title="Go to Info Page">
                <p>INFO</p>
            </button>
            <button onclick = "schedule()" class ="sidebar-button" href="faculty-schedule.php" title="Go to Schedule Page">
                <p>SCHEDULE</p>
            </button>
            <button onclick = "admin()" class ="sidebar-button" href="faculty-admin.php" title="Go to Admin Page">
                <p>ADMIN</p>
            </button>
            <div class = "sidebar-button">
                <p>Copyright 2023, TCCP.<br>All rights reserved.</p>
            </div>
        </div>

        <div class="main-area">
            <div class = "main-area-header">
                <p style = "width: 80%; text-align: center;">F A C U L T Y&nbsp;&nbsp;&nbsp;H O M E</p>
            </div>
            <div class="main-area-content-box">
                
                <div class="id-picture"></div>
                <div class="main-info-container">
                    NAME:
                    <br>
                    <?php echo $row['name']; ?>
                    <br>
                    OCCUPATION:
                    <br>
                    <?php echo $row['occupation']; ?>
                    <br>
                    ADDRESS:
                    <br>
                    <?php echo $row['address']; ?>
                    <br>
                    E-MAIL:
                    <br>
                    <?php echo $row['facultyEmail']; ?>
                </div>
                <div class="gwa-container">
                    <p style="padding-right: 0.5%;">SALARY: </p>
                    <p style="padding-right: 0.1%;"><?php echo $row['salary']; ?></p>
                </div>

            </div>
        </div>
    </div>
</body>
<script>
    function home() {
        const facultyEmailForm = document.getElementById("sendEmailHome");
        facultyEmailForm.submit();
    }

    function info() {
        const facultyEmailForm = document.getElementById("sendEmailInfo");
        facultyEmailForm.submit();
    }

    function schedule() {
        const facultyEmailForm = document.getElementById("sendEmailSchedule");
        facultyEmailForm.submit();
    }

    function admin() {
        const facultyEmailForm = document.getElementById("sendEmailAdmin");
        facultyEmailForm.submit();
    }
</script>
</html>