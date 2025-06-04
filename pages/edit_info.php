<?php
    
    if(isset($_POST["vpassNo"])) {
        $vpassNo                = $_POST["vpassNo"];
        $requestedBy            = $_POST["requestedBy"];
        $date                   = $_POST["date"];
        $deptMgr                = $_POST["deptMgr"];
        $status                 = $_POST["status"];
        $nameOfVisitor          = $_POST["nameOfVisitor"];
        $company                = $_POST["company"];
        $position               = $_POST["position"];
        $address                = $_POST["address"];
        $purposeOfVisit         = $_POST["purposeOfVisit"];
        $parkingInsideFCI       = $_POST["parkingInsideFCI"];
        $allowCam               = $_POST["allowCam"];
        $camJustification       = $_POST["camJustification"];
        $areasToPic             = $_POST["areasToPic"];
        $personsToBeVisited     = $_POST["personsToBeVisited"];
        $areaToBeVisited        = $_POST["areaToBeVisited"];
        $dateOfVisit            = $_POST["dateOfVisit"];
        $timeOfVisit            = $_POST["timeOfVisit"];
        $durationOfDayVisit     = $_POST["durationOfDayVisit"];
        $escort                 = $_POST["escort"];
        $actualDateIn           = $_POST["actualDateIn"];
        $timeIn                 = $_POST["timeIn"];
        $actualTimeOut          = $_POST["actualTimeOut"];

        $connection = new PDO("sqlsrv:server=10.104.37.24; Database=TESTDATABASE", "testuser", "testuser"); 
    
        $sql_query = "
            UPDATE [dbo].[Visitor's_Day_Pass]
            SET [vpassNo] = '$vpassNo', [requestedBy] = '$requestedBy', [date] = '$date'
            , [deptMgr] = '$deptMgr', [status] = '$status', [nameOfVisitor] = '$nameOfVisitor', [company] = '$company'
            , [position] = '$position', [address] = '$address', [purposeOfVisit] = '$purposeOfVisit', [parkingInsideFCI] = '$parkingInsideFCI'
            , [allowCam] = '$allowCam', [camJustification] = '$camJustification', [areasToPic] = '$areasToPic'
            , [personsToBeVisited] = '$personsToBeVisited', [areaToBeVisited] = '$areaToBeVisited', [dateOfVisit] = '$dateOfVisit'
            , [timeOfVisit] = '$timeOfVisit', [durationOfDayVisit] = '$durationOfDayVisit', [escort] = '$escort'
            , [actualDateIn] = '$actualDateIn', [timeIn] = '$timeIn', [actualTimeOut] = '$actualTimeOut'
            WHERE vpassNo = '$vpassNo'
        ";
        
       $statement = $connection->prepare($sql_query);
        $statement->execute();

        echo json_encode("true");
    } else {
        echo json_encode("false");
    }

?>