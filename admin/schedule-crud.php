<?php
    include '../pages/login/dbcon.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.css"/>

    <style>
        body, html{
            padding: 20px;
            background-color: #a0a0a0;
        }
    </style>
    <title>ADMIN ONLY</title>
</head>
<body>

    <form id = "checkHome" action="admin-home.php" method = "post">
        <input type="hidden" name = "loggedin" value = "yes">
    </form>

    <?php
        if ($_POST['loggedin'] != "yes") {
            header("location: ../index.html");
        }
    ?>

    <div style="text-align: center; font-size: 30pt; font-weight: bold;">
        SCHEDULE CRUD
    </div>

    <div style= "text-align: right; padding-bottom: 1%;">
        <button type="button" class="btn btn-danger" onclick = "home()">Back</button>
    </div>

    <div style= "text-align: right; padding-bottom: 1%;">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newmodal">New Schedule</button>
    </div>

    <!-- New User Modal -->
    <div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
            <form action="admin-controller.php" method="POST">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Schedule</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="new-subject">Select Subject:</label>
                                <select class="form-control" name="new-subject" id="new-subject">
                                    <?php
                                        $sql2 = "SELECT `subject` FROM `subject` ORDER BY `subject`";
                                        $stmt2 = $con->prepare($sql2);
                                        $stmt2->execute();
                                        $result2 = $stmt2->get_result();
                                        while ($row2 = $result2->fetch_assoc()) {
                                            ?>
                                                <option value=<?php echo $row2['subject']; ?>><?php echo $row2['subject']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="new-course">Course:</label>
                                <select class="form-control" name="new-course" id="new-course">
                                    <?php
                                        $sql3 = "SELECT `course` FROM course ORDER BY `course`";
                                        $stmt3 = $con->prepare($sql3);
                                        $stmt3->execute();
                                        $result3 = $stmt3->get_result();
                                        while ($row3 = $result3->fetch_assoc()) {
                                            ?>
                                                <option value=<?php echo $row3['course']; ?>><?php echo $row3['course']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="new-section">Section:</label>
                                <select class="form-control" name="new-section" id="new-section">
                                    <?php
                                        $sql4 = "SELECT `section` FROM section ORDER BY `section`";
                                        $stmt4 = $con->prepare($sql4);
                                        $stmt4->execute();
                                        $result4 = $stmt4->get_result();
                                        while ($row4 = $result4->fetch_assoc()) {
                                            ?>
                                                <option value=<?php echo $row4['section']; ?>><?php echo $row4['section']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="new-day">Day (Numbers only: 1-6 for Monday to Sat):</label>
                                <input type="text" class="form-control" id="new-day" name="new-day">
                            </div>
                            
                            <div class="form-group">
                                <label for="new-start">Start Time (HH:MM 24-Hour Format):</label>
                                <input type="text" class="form-control" id="new-start" name="new-start">
                            </div>

                            <div class="form-group">
                                <label for="new-end">End Time (HH:MM 24-Hour Format):</label>
                                <input type="text" class="form-control" id="new-end" name="new-end">
                            </div>

                            <div class="form-group">
                                <label for="new-room">Room (4 chars only):</label>
                                <input type="text" class="form-control" id="new-room" name="new-room">
                            </div>

                            <div class="form-group">
                                <label for="new-prof">Professor:</label>
                                <select class="form-control" name="new-prof" id="new-prof">
                                    <?php
                                        $sql5 = "SELECT `name` FROM faculty ORDER BY `name`";
                                        $stmt5 = $con->prepare($sql5);
                                        $stmt5->execute();
                                        $result5 = $stmt5->get_result();
                                        while ($row5 = $result5->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $row5['name']; ?>"><?php echo $row5['name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add-schedule" class="btn btn-primary">Add Schedule</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>

    <table table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th scope="col">User ID</th>
            <th scope="col">Subject</th>
            <th scope="col">Course</th>
            <th scope="col">Section</th>
            <th scope="col">Day</th>
            <th scope="col">Start</th>
            <th scope="col">End</th>
            <th scope="col">Room</th>
            <th scope="col">Professor</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $sql="SELECT * FROM schedule";
                $stmt=$con->prepare($sql);
                $stmt->execute();
                $result=$stmt->get_result();
                while($row=$result->fetch_assoc()){
            ?>
            <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['course']; ?></td>
            <td><?php echo $row['section']; ?></td>
            <td><?php echo $row['day']; ?></td>
            <td><?php echo $row['start']; ?></td>
            <td><?php echo $row['end']; ?></td>
            <td><?php echo $row['room']; ?></td>
            <td><?php echo $row['professor']; ?></td>
            <td>
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#updatemodal-<?php echo $row['id']; ?>">Update</button>
            </td>
            <td>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletemodal-<?php echo $row['id']; ?>">Delete</button>
            </td>
            </tr>

            
            <!-- Update Modal -->
            <div class="modal fade" id="updatemodal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
                <form action="admin-controller.php" method="POST">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['id']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="subject">Select Subject:</label>
                                    <select class="form-control" name="subject" id="subject">
                                        <option value=<?php echo $row['subject']; ?>><?php echo $row['subject']; ?></option>
                                        <?php
                                            $sql2 = "SELECT `subject` FROM `subject` WHERE `subject` != ? ORDER BY `subject`";
                                            $stmt2 = $con->prepare($sql2);
                                            $stmt2->bind_param("s", $row['subject']);

                                            $stmt2->execute();
                                            $result2 = $stmt2->get_result();
                                            while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                    <option value=<?php echo $row2['subject']; ?>><?php echo $row2['subject']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="course">Course:</label>
                                    <select class="form-control" name="course" id="course">
                                        <option value=<?php echo $row['course']; ?>><?php echo $row['course']; ?></option>
                                        <?php
                                            $sql3 = "SELECT `course` FROM course WHERE `course` != ? ORDER BY `course`";
                                            $stmt3 = $con->prepare($sql3);
                                            $stmt3->bind_param("s", $row['course']);
                                            
                                            $stmt3->execute();
                                            $result3 = $stmt3->get_result();
                                            while ($row3 = $result3->fetch_assoc()) {
                                                ?>
                                                    <option value=<?php echo $row3['course']; ?>><?php echo $row3['course']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="section">Section:</label>
                                    <select class="form-control" name="section" id="section">
                                        <option value=<?php echo $row['section']; ?>><?php echo $row['section']; ?></option>
                                        <?php
                                            $sql4 = "SELECT `section` FROM section WHERE `section` != ? ORDER BY `section`";
                                            $stmt4 = $con->prepare($sql4);
                                            $stmt4->bind_param("s", $row['section']);

                                            $stmt4->execute();
                                            $result4 = $stmt4->get_result();
                                            while ($row4 = $result4->fetch_assoc()) {
                                                ?>
                                                    <option value=<?php echo $row4['section']; ?>><?php echo $row4['section']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="day">Day (Numbers only: 1-6 for Monday to Sat):</label>
                                    <input type="text" class="form-control" value="<?php echo $row['day']; ?>"  name="day" id="day">
                                </div>
                                
                                <div class="form-group">
                                    <label for="start">Start Time (HH:MM 24-Hour Format):</label>
                                    <input type="text" class="form-control" value="<?php echo $row['start']; ?>"  name="start" id="start">
                                </div>

                                <div class="form-group">
                                    <label for="end">End Time (HH:MM 24-Hour Format):</label>
                                    <input type="text" class="form-control" value="<?php echo $row['end']; ?>" id="end" name="end">
                                </div>

                                <div class="form-group">
                                    <label for="room">Room (4 chars only):</label>
                                    <input type="text" class="form-control" value="<?php echo $row['room']; ?>" id="room" name="room">
                                </div>

                                <div class="form-group">
                                    <label for="prof">Professor:</label>
                                    <select class="form-control" name="prof" id="prof">
                                        <option value=<?php echo $row['professor']; ?>><?php echo $row['professor']; ?></option>
                                        <?php
                                            $sql5 = "SELECT `name` FROM faculty WHERE `name` != ? ORDER BY `name`";
                                            $stmt5 = $con->prepare($sql5);
                                            $stmt5->bind_param("s", $row['professor']);

                                            $stmt5->execute();
                                            $result5 = $stmt5->get_result();
                                            while ($row5 = $result5->fetch_assoc()) {
                                                ?>
                                                    <option value="<?php echo $row5['name']; ?>"><?php echo $row5['name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" id="id" name="id">
                            <button type="submit" name="update-schedule" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Delete Modal -->
            <div class="modal fade" id="deletemodal-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <form action="admin-controller.php" method="POST">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['id']; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <div class="modal-body">
                        <h4> Do you want to delete this particular data?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" id="id" name="id">
                            <button type="submit" name="delete-schedule" class="btn btn-primary">Continue</button>
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            
            <?php } ?>
        </tbody>
    </table>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.25/b-1.7.1/b-html5-1.7.1/b-print-1.7.1/datatables.min.js"></script>

    <script type="text/javascript">
    $(document).ready(function(){
        $('#example').DataTable({
            dom: 'Blfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });
    });
    </script>
</body>
<script>
    function home() {
        const form = document.getElementById("checkHome");
        form.submit();
    }
</script>
</html>