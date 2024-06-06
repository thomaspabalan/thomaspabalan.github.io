<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processing...</title>
</head>
<body>
    <form id = "checkHome" action="admin-home.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

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

    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        include '../pages/login/dbcon.php';

        if(isset($_POST['add-student'])) {
            $studentNum = $_POST['new-studentNum'];
            $password = $_POST['new-password'];
            $name = $_POST['new-name'];
            $age = $_POST['new-age'];
            $course = $_POST['new-course'];
            $section = $_POST['new-section'];
            $birthday = $_POST['new-birthday'];
            $address = $_POST['new-address'];

            $sql = "INSERT INTO `student`(`studentNum`, `password`, `name`, `course`, `section`, `birthday`, `address`, `age`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("issssssi", $studentNum, $password, $name, $course, $section, $birthday, $address, $age);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkStudent");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-student'])) {
            $studentNum = $_POST['studentNum'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $course = $_POST['course'];
            $section = $_POST['section'];
            $birthday = $_POST['birthday'];
            $address = $_POST['address'];
            $id = $_POST['id'];

            $sql = "UPDATE `student` SET `studentNum`= ?, `password` = ?, `name` = ?, `course` = ?, `section` =  ?, `birthday` = ?, `address` = ?, `age` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("issssssii", $studentNum, $password, $name, $course, $section, $birthday, $address, $age, $id);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkStudent");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-student'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM student WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkStudent");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['add-faculty'])) {
            $facultyEmail = $_POST['new-facultyEmail'];
            $password = $_POST['new-password'];
            $name = $_POST['new-name'];
            $age = $_POST['new-age'];
            $occupation = $_POST['new-occupation'];
            $address = $_POST['new-address'];
            $birthday = $_POST['new-birthday'];
            $salary = $_POST['new-salary'];

            $sql = "INSERT INTO `faculty`(`facultyEmail`, `password`, `name`, `age`, `occupation`, `address`, `birthday`, `salary`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("sssisssi", $facultyEmail, $password, $name, $age, $occupatiob, $address, $birthday, $salary);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkFaculty");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-faculty'])) {
            $facultyEmail = $_POST['facultyEmail'];
            $password = $_POST['password'];
            $name = $_POST['name'];
            $age = $_POST['age'];
            $occupation = $_POST['occupation'];
            $address = $_POST['address'];
            $birthday = $_POST['birthday'];
            $salary = $_POST['salary'];
            $id = $_POST['id'];

            $sql = "UPDATE `student` SET `facultyEmail`= ?, `password` = ?, `name` = ?, `age` = ?, `occupation` =  ?, `address` = ?, `birthday` = ?, `salary` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("sssisssii", $facultyEmail, $password, $name, $age, $occupation, $address, $birthday, $salary, $id);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkFaculty");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-faculty'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM faculty WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkFaculty");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['add-admin'])) {
            $username = $_POST['new-username'];
            $password = $_POST['new-password'];

            $sql = "INSERT INTO `admin`(`username`, `password`) VALUES (?, ?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("ss", $username, $password);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkAdmin");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-admin'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $id = $_POST['id'];

            $sql = "UPDATE `admin` SET `username`= ?, `password` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("ssi", $username, $password, $id);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkAdmin");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-admin'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM `admin` WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkAdmin");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['add-subject'])) {
            $subject = $_POST['new-subject'];

            $sql = "INSERT INTO `subject`(`subject`) VALUES (?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("s", $subject);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkSubject");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-subject'])) {
            $subject = $_POST['subject'];
            $id = $_POST['id'];

            $sql = "UPDATE `subject` SET `subject` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("si", $subject, $id);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkSubject");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-subject'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM `subject` WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkSubject");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['add-course'])) {
            $course = $_POST['new-course'];

            $sql = "INSERT INTO `course`(`course`) VALUES (?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("s", $course);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkCourse");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-course'])) {
            $course = $_POST['course'];
            $id = $_POST['id'];

            $sql = "UPDATE `course` SET `course` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("si", $course, $id);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkCourse");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-course'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM `course` WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkCourse");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['add-section'])) {
            $section = $_POST['new-section'];

            $sql = "INSERT INTO `section`(`section`) VALUES (?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("s", $section);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkSection");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-section'])) {
            $section = $_POST['section'];
            $id = $_POST['id'];

            $sql = "UPDATE `section` SET `section` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("si", $section, $id);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkSection");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-section'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM `section` WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkSection");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['add-grades'])) {
            $studentNum = $_POST['new-studentNum'];
            $subject = $_POST['new-subject'];
            $midterm = $_POST['new-midterm'];
            $final = $_POST['new-final'];

            $sql = "INSERT INTO `grades`(`studentNum`, `subject`, `midterm`, `final`) VALUES (?, ?, ?, ?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("isdd", $studentNum, $subject, $midterm, $final);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkGrades");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-grades'])) {
            $studentNum = $_POST['studentNum'];
            $subject = $_POST['subject'];
            $midterm = $_POST['midterm'];
            $final = $_POST['final'];
            $id = $_POST['id'];

            $sql = "UPDATE `grades` SET `studentNum`= ?, `subject` = ?, `midterm` = ?, `final` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("isddi", $studentNum, $subject, $midterm, $final, $id);
                
                $stmt->execute();

                ?>
                <script>
                    const form = document.getElementById("checkGrades");
                    form.submit();
                </script>
                <?php
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-grades'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM grades WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkGrades");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['add-schedule'])) {
            $subject = $_POST['new-subject'];
            $course = $_POST['new-course'];
            $section = $_POST['new-section'];
            $day = $_POST['new-day'];
            $start = $_POST['new-start'];
            $end = $_POST['new-end'];
            $room = $_POST['new-room'];
            $prof = $_POST['new-prof'];

            $sql = "INSERT INTO `schedule`(`subject`, `course`, `section`, `day`, `start`, `end`, `room`, `professor`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("sssissss", $subject, $course, $section, $day, $start, $end, $room, $prof);
                
                if($stmt->execute()) {
                    ?>
                    <script>
                        const form = document.getElementById("checkSchedule");
                        form.submit();
                    </script>
                    <?php
                } else {
                    echo $prof;
                    $error = $stmt->errno . ' ' . $stmt->error;
                    echo $error;
                }

                
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['update-schedule'])) {
            $subject = $_POST['subject'];
            $course = $_POST['course'];
            $section = $_POST['section'];
            $day = $_POST['day'];
            $start = $_POST['start'];
            $end = $_POST['end'];
            $room = $_POST['room'];
            $prof = $_POST['prof'];
            $id = $_POST['id'];

            $sql = "UPDATE `schedule` SET `subject`= ?, `course` = ?, `section` = ?, `day` = ?, `start` =  ?, `end` = ?, `room` = ?, `professor` = ? WHERE `id` = ?";

            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("sssissssi", $subject, $course, $section, $day, $start, $end, $room, $prof, $id);
                
                if($stmt->execute()) {
                    ?>
                    <script>
                        const form = document.getElementById("checkSchedule");
                        form.submit();
                    </script>
                    <?php
                } else {
                    echo $prof;
                    $error = $stmt->errno . ' ' . $stmt->error;
                    echo $error;
                }
                
            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

        if(isset($_POST['delete-schedule'])) {
            $id = $_POST['id'];
            
            $sql = "DELETE FROM schedule WHERE id = ?";
            
            if($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                
                $stmt->execute();
                
                ?>
                <script>
                    const form = document.getElementById("checkSchedule");
                    form.submit();
                </script>
                <?php

            } else {
                $error = $con->errno . ' ' . $con->error;
                echo $error;
            }
        }

    ?>
</body>
</html>