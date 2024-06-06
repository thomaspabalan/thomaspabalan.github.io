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
        FACULTY CRUD
    </div>

    <div style= "text-align: right; padding-bottom: 1%;">
        <button type="button" class="btn btn-danger" onclick = "home()">Back</button>
    </div>

    <div style= "text-align: right; padding-bottom: 1%;">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newmodal">New User</button>
    </div>

    <!-- New User Modal -->
    <div class="modal fade" id="newmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            
            <form action="admin-controller.php" method="POST">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">New User</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="new-facultyEmail">E-mail:</label>
                                <input type="text" class="form-control" id="new-facultyEmail" name="new-facultyEmail">
                            </div>

                            <div class="form-group">
                                <label for="new-password">Password:</label>
                                <input type="text" class="form-control" id="new-password" name="new-password">
                            </div>

                            <div class="form-group">
                                <label for="new-name">Full Name:</label>
                                <input type="text" class="form-control" id="new-name" name="new-name">
                            </div>
                
                            <div class="form-group">
                                <label for="new-age">Age:</label>
                                <input type="text" class="form-control" name="new-age" id="new-age">
                            </div>
                            
                            <div class="form-group">
                                <label for="new-occupation">Occupation:</label>
                                <input type="text" class="form-control" id="new-occupation" name="new-occupation">
                            </div>
                            
                            <div class="form-group">
                                <label for="new-address">Address:</label>
                                <input type="text" class="form-control" id="new-address" name="new-address">
                            </div>

                            <div class="form-group">
                                <label for="new-birthday">Birthday (YYYY-MM-DD):</label>
                                <input type="text" class="form-control" id="new-birthday" name="new-birthday">
                            </div>

                            <div class="form-group">
                                <label for="new-salary">Salary:</label>
                                <input type="text" class="form-control" id="new-salary" name="new-salary">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="add-faculty" class="btn btn-primary">Add User</button>
                    </div>
                    </div>
                </div>
            </form>
        </div>

    <table table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
            <th scope="col">User ID</th>
            <th scope="col">Faculty Email</th>
            <th scope="col">Password</th>
            <th scope="col">Name</th>
            <th scope="col">Age</th>
            <th scope="col">Occupation</th>
            <th scope="col">Address</th>
            <th scope="col">Birthday</th>
            <th scope="col">Salary</th>
            <th scope="col">Update</th>
            <th scope="col">Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php

                $sql="SELECT * FROM faculty";
                $stmt=$con->prepare($sql);
                $stmt->execute();
                $result=$stmt->get_result();
                while($row=$result->fetch_assoc()){
            ?>
            <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['facultyEmail']; ?></td>
            <td><?php echo $row['password']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['age']; ?></td>
            <td><?php echo $row['occupation']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['birthday']; ?></td>
            <td><?php echo $row['salary']; ?></td>
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
                                    <label for="facultyEmail">E-mail:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['facultyEmail']; ?>" id="facultyEmail" name="facultyEmail">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['password']; ?>" id="password" name="password">
                                </div>

                                <div class="form-group">
                                    <label for="name">Full Name:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['name']; ?>" id="name" name="name">
                                </div>
                    
                                <div class="form-group">
                                    <label for="age">Age:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['age']; ?>"  name="age" id="age">
                                </div>
                                
                                <div class="form-group">
                                    <label for="occupation">Occupation:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['occupation']; ?>"  name="occupation" id="occupation">
                                </div>
                                
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['address']; ?>"  name="address" id="address">
                                </div>

                                <div class="form-group">
                                    <label for="birthday">Birthday (YYYY-MM-DD):</label>
                                    <input type="text" class="form-control" value="<?php echo $row['birthday']; ?>" id="birthday" name="birthday">
                                </div>

                                <div class="form-group">
                                    <label for="salary">Salary:</label>
                                    <input type="text" class="form-control" value="<?php echo $row['salary']; ?>" id="salary" name="salary">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="hidden" class="form-control" value="<?php echo $row['id']; ?>" id="id" name="id">
                            <button type="submit" name="update-faculty" class="btn btn-primary">Save changes</button>
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
                            <button type="submit" name="delete-faculty" class="btn btn-primary">Continue</button>
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