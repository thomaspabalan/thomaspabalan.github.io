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
        GRADES CRUD
    </div>

    <div style= "text-align: right; padding-bottom: 1%;">
        <button type="button" class="btn btn-danger" onclick = "home()">Back</button>
    </div>

    <div style= "text-align: right; padding-bottom: 1%;">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newmodal">Add Grade</button>
    </div>

    <!-- New User Modal -->
    <div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
            <form action="admin-controller.php" method="POST">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New Grade</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                            
                            <div class="form-group">
                                <label for="new-studentNum">Select Student:</label>
                                <select class="form-control" name="new-studentNum" id="new-studentNum">
                                    <?php
                                        $sql2 = "SELECT `studentNum`, `name` FROM student ORDER BY `name`";
                                        $stmt2 = $con->prepare($sql2);
                                        $stmt2->execute();
                                        $result2 = $stmt2->get_result();
                                        while ($row2 = $result2->fetch_assoc()) {
                                            ?>
                                                <option value=<?php echo $row2['studentNum']; ?>><?php echo $row2['name']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="new-subject">Select Subject:</label>
                                <select class="form-control" name="new-subject" id="new-subject">
                                    <?php
                                        $sql3 = "SELECT `subject` FROM `subject` ORDER BY `subject`";
                                        $stmt3 = $con->prepare($sql3);
                                        $stmt3->execute();
                                        $result3 = $stmt3->get_result();
                                        while ($row3 = $result3->fetch_assoc()) {
                                            ?>
                                                <option value=<?php echo $row3['subject']; ?>><?php echo $row3['subject']; ?></option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="new-midterm">Midterm Grade:</label>
                                <input type="text" class="form-control" id="new-midterm" name="new-midterm">
                            </div>

                            <div class="form-group">
                                <label for="new-final">Final Grade:</label>
                                <input type="text" class="form-control" id="new-final" name="new-final">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add-grades" class="btn btn-primary">Add Grade</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>

    <table table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th scope="col">User ID</th>
            <th scope="col">Student Number</th>
            <th scope="col">Student Name</th>
            <th scope="col">Subject</th>
            <th scope="col">Midterm</th>
            <th scope="col">Final</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $sql="SELECT * FROM `grades`";
                $stmt=$con->prepare($sql);
                $stmt->execute();
                $result=$stmt->get_result();
                while($row=$result->fetch_assoc()){
                    $sql4 = "SELECT `name` FROM `student` WHERE studentNum = ?";
                    $stmt4 = $con->prepare($sql4);
                    $stmt4->bind_param("i", $row['studentNum']);
                    $stmt4->execute();

                    $result4 = $stmt4->get_result();
                    $row4 = $result4->fetch_assoc();
            ?>
            <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['studentNum']; ?></td>
            <td><?php echo $row4['name']; ?></td>
            <td><?php echo $row['subject']; ?></td>
            <td><?php echo $row['midterm']; ?></td>
            <td><?php echo $row['final']; ?></td>
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
                                    <label for="studentNum">Select Student:</label>
                                    <select class="form-control" name="studentNum" id="studentNum">
                                        <option value=<?php echo $row['studentNum']; ?>><?php echo $row4['name']; ?></option>
                                        <?php
                                            $sql2 = "SELECT `studentNum`, `name` FROM student WHERE `studentNum` != ? ORDER BY `name`";
                                            $stmt2 = $con->prepare($sql2);
                                            $stmt2->bind_param("s", $row['studentNum']);
                                            
                                            $stmt2->execute();
                                            $result2 = $stmt2->get_result();
                                            while ($row2 = $result2->fetch_assoc()) {
                                                ?>
                                                    <option value=<?php echo $row2['studentNum']; ?>><?php echo $row2['name']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="subject">Select Subject:</label>
                                    <select class="form-control" name="subject" id="subject">
                                        <option value=<?php echo $row['subject']; ?>><?php echo $row['subject']; ?></option>
                                        <?php
                                            $sql3 = "SELECT `subject` FROM `subject` WHERE `subject` != ? ORDER BY `subject`";
                                            $stmt3 = $con->prepare($sql3);
                                            $stmt3->bind_param("s", $row['subject']);

                                            $stmt3->execute();
                                            $result3 = $stmt3->get_result();
                                            while ($row3 = $result3->fetch_assoc()) {
                                                ?>
                                                    <option value=<?php echo $row3['subject']; ?>><?php echo $row3['subject']; ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="midterm">Midterm Grade:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['midterm']; ?>" id="midterm" name="midterm">
                                </div>

                                <div class="form-group">
                                    <label for="final">Final Grade:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['final']; ?>" id="final" name="final">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" id="id" name="id">
                            <button type="submit" name="update-grades" class="btn btn-primary">Save changes</button>
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
                            <button type="submit" name="delete-grades" class="btn btn-primary">Continue</button>
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