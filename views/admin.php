<include href="views/header.html">
<?php
require_once ("config-dating.php");
/**
 * It-328
 * Imelda Medina
 * 2/25/2020
 * This php file validates the users form and inserts the data into the sql if data is valid
 */

//Start a session
session_start();

////ERROR reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="styles/styles.css">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Questrial&display=swap" rel="stylesheet">

    <title>Member Summary Form</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="images/heart.jpeg">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
</head>
<body>

<div class="container">
    <br>
    <form class="form-inline">
        <h3 class="mr-5">Membership</h3>
        <div class="float-right">
        </div>
    </form>
    <hr>
    <br>
    <?php

    //Define the query

    $sql='SELECT member.member_id, fname, lname, age,gender,phone, email,state, seeking,premium 
        FROM member     
        ORDER BY member.lname ASC ';



    //2. Prepare the statement
    $statement = $this->_dbh->prepare($sql);

    //4. Execute the statement
    $statement->execute();

    //5. Get the result
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $result;
var_dump($result);
    ?>
    <table id="dating-table" class="display">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Age</th>
            <th>Phone Number</th>
            <th>Email</th>
            <th>State</th>
            <th>Gender</th>
            <th>Seeking</th>
            <th>Premium</th>
            <th>Interests</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //Print the results
//        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
//        return $result;
            //the parameter names are the same that I have on my database
            $member_Id = $result['member_id'];
            $name = $result['fname'];
            $lname = $result['lname'];
            $age = $result['age'];
            $gender = $result['gender'];
            $phone = $result['phone'];
            $email = $result['email'];
            $state = $result['state'];
            $seeking = $result['seeking'];
//            $bio = $result['bio'];
            $premium = $result['premium'];
            //interests

            $interest = $result['interest'];

            echo "<tr>
           
        <td>$member_Id</td>
        <td>$name $lname</td>
        <td>$age</td>
        <td>$phone</td>
        <td>$email</td>
        <td>$state</td>
        <td>$gender</td>
        <td>$seeking</td>";
            if($premium ==1){
                echo"<td><input type=\"checkbox\" name=\"name1\" checked />&nbsp;</td>";
            }else {
                echo"<td><input type=\"checkbox\" name=\"name1\" />&nbsp;</td>";
            }
            echo"
        <td>$interest</td>
        </tr>";

        ?>
        </tbody>
    </table>

    <br>

</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="//cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script>
    // $('#dreamer-table').DataTable();
    // $('#dreamer-table').DataTable({"order":[0,'desc']});
    $('#dating-table').DataTable( {
        order:[0,'desc'],
        responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Details for '+data[0]+' '+data[1];
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },
    } );
</script>

</body>
</html>


