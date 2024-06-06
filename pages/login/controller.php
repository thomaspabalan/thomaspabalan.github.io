<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing...</title>
</head>
<body>
    <form id = "checkLogin" action="../../admin/admin-home.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        include 'dbcon.php';

        if(isset($_POST['login'])) {
            $studentNum = $_POST['studentNum'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM student WHERE studentNum = ? AND `password` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("is", $studentNum, $password);
                $stmt->execute();

                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($result->num_rows == 1) {
                    ?>
                        <form id = "sendNumHome" action="../../student/home.php" method = "post">
                            <input type="hidden" name = "sNumVal" value = "<?php echo $studentNum; ?>">
                        </form>

                        <script>
                            const studentNumForm = document.getElementById("sendNumHome");
                            studentNumForm.submit();
                        </script>
                    <?php
                } else {
                    header("location: student.php");
                }
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['faculty-login'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM faculty WHERE facultyEmail = ? AND `password` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();

                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($result->num_rows == 1) {
                    ?>
                        <form id = "sendEmailHome" action="../../faculty/faculty-home.php" method = "post">
                            <input type="hidden" name = "emailVal" value = "<?php echo $email; ?>">
                        </form>

                        <script>
                            const facultyEmailForm = document.getElementById("sendEmailHome");
                            facultyEmailForm.submit();
                        </script>
                    <?php
                } else {
                    header("location: faculty.php");
                }
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['admin-login'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['emailVal'];

            $sql = "SELECT * FROM `admin` WHERE `username` = ? AND `password` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("ss", $username, $password);
                $stmt->execute();

                $result = $stmt->get_result();
                $row = $result->fetch_assoc();

                if($result->num_rows == 1) {
                    ?>
                        <script>
                            const form = document.getElementById("checkLogin");
                            form.submit();
                        </script>
                    <?php
                } else {
                    ?>
                        <form id = "sendEmailAdmin" action="../../faculty/faculty-admin.php" method = "post">
                            <input type="hidden" name = "emailVal" value = <?php echo $email; ?>>
                        </form>

                        <script>
                            const facultyEmailForm = document.getElementById("sendEmailAdmin");
                            facultyEmailForm.submit();
                        </script>
                    <?php
                }
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }
    ?>
</body>
</html>