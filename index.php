<?php
    $vpassNo = "";
    $status = "";

    if(isset($_GET["vpassNo"])) {
        $vpassNo = $_GET["vpassNo"];
    }
    
    if(isset($_GET["status"])) {
        $status = $_GET["status"];
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor's Day Pass</title>
    <link rel="stylesheet" href="assets/css/bulma.css">
    <link rel="icon" href="assets/images/funai.png" type="image/png"> 
    <style>
        body{
            margin: 0;
        }
        .cell-spacing td { 
            padding: 2px; 
        }

        body {
            width: 25rem;
        }

        .panel-heading {
            background-color: #e0d2d1;
        }

        .button {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="tile m-6">
		<div class="tile is-8">
			<nav class="panel">
				<p class="panel-heading">
					Login
				</p>
				<div class="panel-block">
					<form action="test.php" method="post">
                        <table>
                            <tr class="cell-spacing">
                                <input type="hidden" name="vpassNo" value="<?=$vpassNo?>">
                                <input type="hidden" name="status" value="<?=$status?>">
                                <td><label>Username:</label></td>
                                <td><input type="text" class="input is-small fas fa-check" name="username"></td>
                            </tr>
                            <tr class="cell-spacing">
                                <td><label>Password:</label></td>
                                <td><input type="password" class="input is-small" name="password"></td>
                            </tr>
                            <tr class="cell-spacing">
                                <td></td>
                                <td> <button class="button is-small ml-6 mt-1" type="submit">Login</button> </td>
                            </tr>
                        </table>
                    </form>
				</div>
			</nav>
		</div>
	</div>

</body>
</html>