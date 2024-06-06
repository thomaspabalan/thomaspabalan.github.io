<?php
    include "../pages/login/dbcon.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..\style\index.css"> <!-- css link -->

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

    <title>Admin | Home</title>
</head>
<body>

    <?php
        if ($_POST['loggedin'] != "yes") {
            header("location: ../index.html");
        }
    ?>

    <form id = "checkStudent" action="student-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <form id = "checkFaculty" action="faculty-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <form id = "checkSubject" action="subject-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <form id = "checkCourse" action="course-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <form id = "checkSection" action="section-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <form id = "checkAdmin" action="admin-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <form id = "checkSchedule" action="schedule-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <form id = "checkGrades" action="grades-crud.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <div class = "page">
        <div class="border-accent">&nbsp;<!-- filler so div shows --></div>

        <div class="main-area">
            <div class="title" style="width: 90%; height: 20%;">A D M I N&nbsp;&nbsp;&nbsp;H O M E&nbsp;&nbsp;&nbsp;P A G E</div>
            <div class="description">C h o o s e&nbsp;&nbsp;&nbsp;t a b l e&nbsp;&nbsp;&nbsp;t o&nbsp;&nbsp;&nbsp;e d i t :</div>
            <div class="choose-container-container" style="flex-flow: row wrap; row-gap: 2%;">
                <div class="choose-container">
                    <button class="choose-admin" onclick = "subject()" title="Go to Subject CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);;">S U B J E C T</p></button>
                    <button class="choose-admin" onclick = "course()" title="Go to Course CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);">C O U R S E</p></button>
                    <button class="choose-admin" onclick = "section()" title="Go to Section CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);">S E C T I O N</p></button>
                </div>
                <div class="choose-container">
                    <button class="choose-admin" onclick = "student()" title="Go to Student CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);">S T U D E N T</p></button>
                    <button class="choose-admin" onclick = "schedule()" title="Go to Schedule CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);">S C H E D U L E</p></button>
                    <button class="choose-admin" onclick = "faculty()" title="Go to Faculty CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);">F A C U L T Y</p></button>
                </div>
                <div class="choose-container">
                    <button class="choose-admin" onclick = "admin()" title="Go to Admin CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);">A D M I N</p></button>
                    <button class="choose-admin" onclick = "grades()" title="Go to Grades CRUD"><p style="width: 80%; text-align: center; transform: skewX(20deg);">G R A D E S</p></button>
                    <button class="choose-admin" onclick = "home()" title="Go back to Home Page"><p style="width: 80%; text-align: center; transform: skewX(20deg);">H O M E</p></button>
                </div>
            </div>
            
        </div>

        <div class="border-accent">
            <p>&nbsp;</p> <!-- filler so div shows -->
        </div>
    </div>
</body>
<script>
    function home() {
        window.location.replace("../index.html");
    }
    function student() {
        const form = document.getElementById("checkStudent");
        form.submit();
    }
    function faculty() {
        const form = document.getElementById("checkFaculty");
        form.submit();
    }
    function subject() {
        const form = document.getElementById("checkSubject");
        form.submit();
    }
    function course() {
        const form = document.getElementById("checkCourse");
        form.submit();
    }
    function section() {
        const form = document.getElementById("checkSection");
        form.submit();
    }
    function admin() {
        const form = document.getElementById("checkAdmin");
        form.submit();
    }
    function schedule() {
        const form = document.getElementById("checkSchedule");
        form.submit();
    }
    function grades() {
        const form = document.getElementById("checkGrades");
        form.submit();
    }
</script>
</html>