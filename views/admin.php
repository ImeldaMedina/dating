<include href="views/header.html">

    <?php
require_once ("config-dating.php");
/**
 * It-328
 * Imelda Medina
 * 2/25/2020
 * This php file validates the users form and inserts the data into the sql if data is valid
 */


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
            <table id="dating-table" class="display">
	        <thead>
	        <tr>
	            <th>ID</th>
	            <th>Name</th>
	            <th>Age</th>
	            <th>Phone</th>
	            <th>Email</th>
	            <th>State</th>
	            <th>Gender</th>
	            <th>Seeking</th>
	            <th>Premium</th>
	            <th>Interests</th>
	        </tr>
	        </thead>
	        <tbody>
<!--            for each member in the array...-->
<!--            echo a table row with that member's data-->
	        <repeat group="{{ @members }}" value="{{ @member }}">
	            <tr>
	                <td>{{ @member['member_id'] }}</td>
	                <td>{{ @member['fname'] }} {{ @member['lname'] }}</td>
	                <td>{{ @member['age'] }}</td>
	                <td>{{ @member['phone'] }}</td>
	                <td>{{ @member['email'] }}</td>
	                <td>{{ @member['state'] }}</td>
                    <td>{{ @member['gender'] }}</td>
	                <td>{{ @member['seeking'] }}</td>
	                <td>
	                    <check if="{{ @member['premium'] == 0}}">
	                        <true><input type="checkbox"></true>
	                        <false><input type="checkbox" checked></false>
	                    </check>
	                </td>
<!--	                <td>{{ @member['interests'] }}</td>-->
	            </tr>
	        </repeat>
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

