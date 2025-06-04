<?php
    session_start();
    
    $username = isset($_SESSION['username']) ? $_SESSION['username'] : '';
    $authorizedUser = 'admin'; //Has access on delete button
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor's Pass</title>
    <link rel="icon" href="../assets/images/funai.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/bulma.css">
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/vue.js"></script>
    
    <style>
        .pass-container {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .section-header, .section-bottom {
            font-weight: bold;
            border-bottom: 1px solid black;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .section-bottom {
            border-top: 1px solid black;
            padding-top: 10px;
            margin-bottom: 1.5rem;
        }

        .field {
            margin-bottom: 10px;
        }

        .table-container {
            overflow-x: auto;
        }

        .is-flex {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .purpose {
            display: flex;
            justify-content: center;
        }

        .newVisitorInfo {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1 !important;
        }

        .b-select-fix::after {
            z-index: 0 !important;
        }

        .box {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .visitorInfo {
            display: none;
        }

        .addBtn, .addVisitBtn {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-left: 50%;
            margin-top: 1rem;
        }

        .newVisitedInfo {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 1 !important;
        }

        .n-modal-window {
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            overflow: auto;
            display: none;
            background-color: rgba(0, 0, 0, 0.4);
        }

        .closeBtn, .submitBtn, .logoutBtn, .addVisitorBtn, .approveBtn, .saveData, .closeVisitorBtn, .closeVisitedBtn {
            margin-left: 92%;
        }

        /* Responsive styles */
        @media (max-width: 624px) {
            .section-header, .section-bottom {
                padding-bottom: 5px;
                margin-bottom: 10px;
            }

            .field {
                margin-bottom: 5px;
            }

            .closeBtn, .submitBtn, .logoutBtn, .addVisitorBtn, .approveBtn, .saveData, .closeVisitorBtn, .addVisitedBtn, .closeVisitedBtn {
                margin-left: 90%;
            }

            .box {
                padding: 10px;
                margin: 5px;
            }

            .table th, .table td {
                padding: 5px;
            }
        }

        @media (max-width: 480px) {
            .closeBtn, .submitBtn, .logoutBtn, .addVisitorBtn, .approveBtn, .saveData, .closeVisitorBtn, .addVisitedBtn, .closeVisitedBtn {
                margin-left: 83%;
            }

            .box {
                padding: 5px;
                margin: 2px;
            }

            .table {
                width: 100%;
                border-collapse: collapse;
            }

            .table th, .table td {
                padding: 3px;
                font-size: 12px; /* Smaller font size for smaller screens */
            }

            .table th, .table td {
                width: 100%; /* Full width for each cell */
            }

            .table th {
                text-align: left; /* Align text to the left */
            }
        }
        
    </style>

</head>
<body bottommargin="0" topmargin="0" leftmargin="0" rightmargin="0">
    
    <!---DISPLAY FORMAT DASHBOARD --->
    <section class="box">        
        <button class="button is-success is-small entryBtn">New entry</button>
        <div class="section-header">
            <h2 class="title is-3 mt-5 ml-5">VISITOR PASS</h2>
        </div>
        <div class="table-container">
            <table class="table is-fullwidth mt-5 tblDataList">
                <tr>
                    <th>Date of Visit</th>
                    <th>Name of Visitor/s</th>
                    <th>Time</th>
                    <th>deptMgr</th>
                    <th>Requested by</th>
                    <th>Status</th>
                    <th>Visitor's Pass</th>
                    <th></th>
                </tr>
            </table>
        </div>
    </section>
    
    <!--- FILL UP FORM --->
    <section class="section n-modal-window">
        <div class="container">
            <div class="box pass-container">
                <!-- Header -->
                <div class="section-header">
                    <button class="button closeBtn is-danger is-small">Close</button>
                    <h2 style="margin-top: -2.3rem;" class="title is-3">Visitor’s Pass</h2>
                </div>

                <!-- First Row -->
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Visitor Pass Number:</label>
                            <input class="input vpassNo" type="text" placeholder="Pass Number">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Date:</label>
                            <input class="input date" type="date">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Status:</label>
                            <div class="select b-select-fix">
                                <select class="status">
                                    <option value="">-- Choose Status --</option>
                                    <option value="Submitted to Dept Manager">Submit to Dept Manager</option>
                                    <option value="Approved">Approved</option>
                                </select>
                            </div> 
                        </div>
                    </div>
                </div>

                <!-- Second Row -->
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Requested by:</label>
                            <input class="input requestedBy" type="text" placeholder="Requested by">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Department Manager:</label>
                            <div class="select b-select-fix">
                                <select class="deptMgr">
                                    <option value="">Select</option>
                                    <option value="wjbastismo">Walter James</option>
                                    <option value="No">No</option>
                                </select>
                            </div>   
                        </div>
                    </div>
                </div>

                <!-- Visitor’s Information -->  
                <div class="section-bottom">
                    <button style="margin-bottom: -2.8%" class="button addVisitorBtn is-success is-small">Add</button>
                    <h3  style="margin-top: -1.8%;" class="title is-5">Visitor's Information</h3>   
                </div>
                <div class="columns visitorInfo">
                    <div class="column ">
                        <div class="field">
                            <label class="label">Name:</label>
                            <textarea class="input nameOfVisitor" type="text" placeholder="Name"></textarea>
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Position:</label>
                            <input class="input position" type="text" placeholder="Position">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Company:</label>
                            <input class="input company" type="text" placeholder="Company">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Address:</label>
                            <input class="input address" type="text" placeholder="Address">
                        </div>
                    </div>
                </div>

                <!---New Visitor Information--->
                <div style="display: none;" class="newVisitorInfo columns ">
                    <div style="width: 500px; border-radius: 10px;" class="box">
                        <button class="button closeVisitorBtn is-danger is-small">Close</button>
                        <label  class="label">Name:</label>
                            <input class="input" id="nameOfVisitor1" type="text" placeholder="Name">
                        <label  class="label">Position:</label>
                            <input class="input" id="position1" type="text" placeholder="Position">
                        <label  class="label">Company:</label>
                            <input class="input" id=" company1" type="text" placeholder="Company">
                        <label  class="label">Address:</label>
                            <input class="input" id="address1" type="text" placeholder="Address">
                            <button class="button is-success addBtn is-small">Add</button>
                    </div>
                </div>
                
                <!---Add Visitor Form--->
                <div style="display: none;" class="visitorList">
                    <div class="columns">
                        <div class="column ">
                            <div class="field">
                                <label class="label">Name:</label>
                                <textarea class="input nameOfVisitor" type="text" placeholder="Name"></textarea>
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Position:</label>
                                <input class="input position" type="text" placeholder="Position">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Company:</label>
                                <input class="input company" type="text" placeholder="Company">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field">
                                <label class="label">Address:</label>
                                <input class="input address" type="text" placeholder="Address">
                            </div>
                        </div>
                        <div class="column">
                            <div class="field"> 
                                <label class="label">Option</label>                               
                                <button class="button is-info is-small mt-1">Edit</button>
                                <button class="button is-primary is-small mt-1">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!---Permissions---> 
                <div class="section-bottom">
                    <h3 class="title is-5">Company Permissions</h3>   
                </div>

                <div class="columns purpose">
                    <div class="column is-one-quarter">
                        <div class="field">
                            <label class="label">Purpose of Visit:</label>
                            <input class="input purposeOfVisit" type="text" placeholder="Purpose">
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Parking inside FCI?</label>
                            <div class="select b-select-fix">
                                <select class="parkingInsideFCI">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>                          
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Allow Camera/Cell with Camera?</label>
                            <div class="select b-select-fix">
                                <select class="allowCam">
                                    <option value="">Select</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                </select>
                            </div>  
                        </div>
                    </div>
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Camera Justification:</label>
                            <input class="input camJustification" type="text" placeholder="Justification">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Areas to be Photographed:</label>
                            <input class="input areasToPic" type="text" placeholder="Areas">
                        </div>
                    </div>
                </div>

                <!-- Person to be Visited -->
                <div class="section-bottom">
                    <h3 class="title is-5">Visit Details</h3>   
                </div>

                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Person to be Visited:<button class="button addVisitedBtn ml-6 is-success is-small">Add</button></label>
                            <input class="input personsToBeVisited" type="text" placeholder="Person's Name">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Area to be Visited:</label>
                            <input class="input areaToBeVisited" type="text" placeholder="Area">
                        </div>
                    </div>
                </div>

                <!---New Person to be Visited Form--->
                <div style="display: none;" class="newVisitedInfo columns ">
                    <div style="width: 500px; border-radius: 10px;" class="box">
                        <button class="button closeVisitedBtn is-danger is-small">Close</button>
                        <label  class="label">Name:</label>
                            <input class="input" id="" type="text" placeholder="Name">
                            <button class="button is-success addVisitBtn is-small">Add</button>
                    </div>
                </div>

                <!---Add Person to be Visited Form--->
                <div style="display: none;" class="visitedList">
                    <div class="columns">
                        <div class="column">
                            <div class="field">
                                <label class="label">Person to be Visited:</label>
                                <input style="width: 49%;" class="input personsToBeVisited" type="text" placeholder="Person's Name">
                                <button class="button is-info is-small mt-1">Edit</button>
                                <button class="button is-primary is-small mt-1">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Visit Details -->
                <div class="columns">
                    <div class="column">
                        <div class="field">
                            <label class="label">Date of Visit:</label>
                            <input class="input dateOfVisit" type="date">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Duration of Visit (day):</label>
                            <input class="input durationOfDayVisit" type="text">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Time of Visit:</label>
                            <input class="input timeOfVisit" type="time">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Escort of the Visitor:</label>
                            <input class="input escort" type="text" placeholder="Escort Name">
                        </div>
                    </div>                            
                </div>

                <!--- FOR SECURITY --->
                <div style="display: none;" class="securityAss columns section-bottom">
                    <div class="column">
                        <div class="field">
                            <label class="label">Actual Date in:</label>
                            <input class="input actualDateIn" type="text" placeholder="Date in">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Actual Time-in:</label>
                            <input class="input timeIn" type="text" placeholder="Time-in">
                        </div>
                    </div>
                    <div class="column">
                        <div class="field">
                            <label class="label">Actual Time-out:</label>
                            <input class="input actualTimeOut" type="text" placeholder="Time-out">
                        </div>
                    </div>                         
                </div>
                <button class="button is-success submitBtn is-small">Submit</button>
                <button style="display: none;" class="button is-success approveBtn">Approve</button>
                <button style="display: none;" class="button is-success saveData">Save</button>
            </div>            
        </div>
    </section>

    <script>
        
        function NewAjaxFunction(url, data, on_receive_data_function ){
            $.ajax({
                url: url,
                data: data,
                dataType: "json",
                method: "post",
            
            }).done(on_receive_data_function).fail(function(error_message){
                console.log(error_message);
            });
        }
        
        //GET DATA VALUE
        function GetValueFromForm(){

            var vpassNo                 = $(".vpassNo").val();
            var requestedBy             = $(".requestedBy").val();
            var date                    = $(".date").val();
            var deptMgr                 = $(".deptMgr option:selected").attr('value');
            var status                  = $(".status option:selected").attr('value');
            var nameOfVisitor           = $(".nameOfVisitor").val();
            var company                 = $(".company").val();
            var position                = $(".position").val();
            var address                 = $(".address").val();
            var purposeOfVisit          = $(".purposeOfVisit").val();
            var parkingInsideFCI        = $(".parkingInsideFCI option:selected").attr('value');
            var allowCam                = $(".allowCam option:selected").attr('value');
            var camJustification        = $(".camJustification").val();
            var areasToPic              = $(".areasToPic").val();
            var personsToBeVisited      = $(".personsToBeVisited").val();
            var areaToBeVisited         = $(".areaToBeVisited").val();
            var dateOfVisit             = $(".dateOfVisit").val();
            var timeOfVisit             = $(".timeOfVisit").val();
            var durationOfDayVisit      = $(".durationOfDayVisit").val();
            var escort                  = $(".escort").val();
            var actualDateIn            = $(".actualDateIn").val();
            var timeIn                  = $(".timeIn").val();
            var actualTimeOut           = $(".actualTimeOut").val();   

            var myClass = {
                vpassNo:                  vpassNo,
                requestedBy:              requestedBy,
                date:                     date,
                deptMgr:                  deptMgr,
                status:                   status,
                nameOfVisitor:            nameOfVisitor,
                company:                  company,
                position:                 position,
                address:                  address,
                purposeOfVisit:           purposeOfVisit,
                parkingInsideFCI:         parkingInsideFCI,
                allowCam:                 allowCam,
                camJustification:         camJustification,
                areasToPic:               areasToPic,
                personsToBeVisited:       personsToBeVisited,
                areaToBeVisited:          areaToBeVisited,
                dateOfVisit:              dateOfVisit,
                timeOfVisit:              timeOfVisit,
                durationOfDayVisit:       durationOfDayVisit,
                escort:                   escort,
                actualDateIn:             actualDateIn,
                timeIn:                   timeIn,
                actualTimeOut:            actualTimeOut,
            };

            return myClass;
        }

        //BUTTONS
        $(document).ready(function() {

            //OPEN FORM
            $('.entryBtn').click(function() {
                $('.section').show('fast');
            });

            //CLOSE FORM
            $('.closeBtn').click(function() {
                $('.section').hide('fast');
            });

            //ADD MORE VISITOR FORM
            $('.addVisitorBtn').on('click', function () {
                $('.newVisitorInfo').show('fast');
            });

            //ADD VISITOR 
            $('.addBtn').on("click", function () {
                $('.visitorList').append("<p>Test</p>");
                $('.visitorList').show("fast");
                $('.newVisitorInfo').hide('fast');
            });

            //CLOSE ADD VISITOR FORM
            $('.closeVisitorBtn').click(function() {
                $('.newVisitorInfo').hide('fast');
            });

            //ADD MORE PERSON TO BE VISITED FORM
            $('.addVisitedBtn').on('click', function () {
                $('.newVisitedInfo').show('fast');
            });

            //ADD PERSON TO BE VISITED
            $('.addVisitBtn').on("click", function () {
                $('.visitedList').append("<p>Test</p>");
                $('.visitedList').show("fast");
                $('.newVisitedInfo').hide('fast');
            });

            //ADD PERSON TO BE VISITED FORM
            $('.closeVisitedBtn').on('click', function () {
                $('.newVisitedInfo').hide('fast');
            });

            //SUBMIT DATA TO SEND 
            $(".submitBtn").click(function() {

                if (confirm("Are you sure you want to submit the data to the Department Manager?")) {

                    NewAjaxFunction("save_Data_To_DB.php", GetValueFromForm(), function(data_from_other_page) {
                        console.log(data_from_other_page);

                        NewAjaxFunction("../phpMailer.php", GetValueFromForm(), function(data_from_other_page) {
                            console.log(data_from_other_page);
                        });

                        setTimeout(function() {
                            alert("Data sent to Department Manager!");                                    
                            location.reload();  
                        }, 2000);
                    });
                } else {
                    console.log("Submission cancelled by the user.");
                }
            });

            //MANAGER'S APPROVAL
            $(".approveBtn").click(function() {
                
                if (confirm("Are you sure you want to Approve?")) {
                    $(".status").val('Approved').change();

                    NewAjaxFunction("edit_info.php", GetValueFromForm(), function(data_from_other_page){
                        console.log(data_from_other_page);
                        alert("Approved Successfully!");

                        NewAjaxFunction("../phpMailer.php", GetValueFromForm(), function(data_from_other_page){

                        console.log(data_from_other_page);
                        });

                        setTimeout(function() {
                            alert("Data sent to Security!"); 
                            window.close();
                            $(".approveBtn").stop();
                        }, 2000); 
                    });
                } else {
                    console.log("Submission cancelled by the user.");
                }
            });

            //SAVE BUTTON FOR SECURITY
            $(".saveData").one('click', function() {

                NewAjaxFunction("edit_info.php", GetValueFromForm(), function(data_from_other_page){
                    console.log(data_from_other_page);

                    setTimeout(function() {
                    alert("Data Save!"); 
                    }, 1000); 
                });
            });
        });

        //DISPLAY OF DATA 
        NewAjaxFunction("display_info.php", {}, function(data_from_other_page){
            $(data_from_other_page).each(function(i, e){
                var new_row = "";

                new_row += "<tr>";
                    new_row += "<td>"+e.dateOfVisit+"</td>";
                    new_row += "<td>"+e.nameOfVisitor+"</td>";
                    new_row += "<td>"+e.timeOfVisit+"</td>";
                    new_row += "<td>"+e.deptMgr+"</td>";
                    new_row += "<td>"+e.requestedBy+"</td>";
                    new_row += "<td>"+e.status+"</td>";
                    new_row += "<td> <input style='text-decoration: none' type='button' class='button is-text  vpassNoBtn has-text-link' vpassNo = "+e.vpassNo+" value="+e.vpassNo+"></td>";
                    new_row += "<td><input type ='button' class='button is-danger is-small deleteBtn' vpassNo = "+e.vpassNo+" value='Delete'></td>";
                    new_row += "</tr>";                    

                $(".tblDataList").append(new_row);
            }); 

            //DELETE BUTTON 
            $(document).ready(function() {
                var username = "<?php echo $username; ?>";
                var authorizedUser = "<?php echo $authorizedUser; ?>";

                // Disable delete buttons if the user is not authorized
                if (username !== authorizedUser) {
                    $(".deleteBtn").prop('disabled', true);
                }

                // Existing JavaScript code
                $(".deleteBtn").click(function() {
                    var vpassNo = $(this).attr("vpassNo");
                    console.log(vpassNo);

                    var myclass = {
                        vpassNo: vpassNo,
                    };

                    if (confirm("Are you sure you want to delete this data?")) {
                        NewAjaxFunction("delete_info.php", myclass, function(data_from_other_page){

                            setTimeout(function() {
                                alert("Deleted successfully!");
                                location.reload();
                            }, 2000);
                        });
                    } else {
                        console.log("Deleting data cancelled by the user.");
                    }
                });
            });
        }); 

        //DISPLAY OF DATA TO IT'S RESPECTIVE FIELDS 
        $(function() {
            var myClass = {
                vpassNo: <?php echo isset($_GET['vpassNo']) ? (int)$_GET['vpassNo'] : 0 ; ?>,
            };

            NewAjaxFunction("get_info_from_DB.php", myClass, function(data){

                $(".vpassNo").val(data.vpassNo);
                $(".requestedBy").val(data.requestedBy);
                $(".date").val(data.date);
                $(".deptMgr").val(data.deptMgr);
                $(".status").val(data.status);
                $(".nameOfVisitor").val(data.nameOfVisitor);
                $(".company").val(data.company);
                $(".position").val(data.position);
                $(".address").val(data.address);
                $(".purposeOfVisit").val(data.purposeOfVisit);
                $(".parkingInsideFCI").val(data.parkingInsideFCI);
                $(".allowCam").val(data.allowCam);
                $(".camJustification").val(data.camJustification);
                $(".areasToPic").val(data.areasToPic);
                $(".personsToBeVisited").val(data.personsToBeVisited);
                $(".areaToBeVisited").val(data.areaToBeVisited);
                $(".dateOfVisit").val(data.dateOfVisit);
                $(".timeOfVisit").val(data.timeOfVisit);
                $(".durationOfDayVisit").val(data.durationOfDayVisit);
                $(".escort").val(data.escort);
                $(".actualDateIn").val(data.actualDateIn);
                $(".timeIn").val(data.timeIn);
                $(".actualTimeOut").val(data.actualTimeOut);       
                
                var userEmail = '<?php echo $_SESSION["username"]; ?>';
            
                //EMAIL STATUS
                var statusEmail = data.status;
                console.log(statusEmail);

            //MANAGER'S EMAIL
                var deptMgrEmail = data.deptMgr;

            //FORWARDED USERS FROM MANAGER
                //var deptMgrEmail = "bati";

            //SECURITY'S EMAIL
                var securityEmail = "wjbastismo";

            //FORWARDED USERS FROM SECURITY
                //var securityEmail = "altadmin";           
                
                if (userEmail === deptMgrEmail && statusEmail === "Submitted to Dept Manager") {
                    $('.section').css('display', 'block');
                    $('.approveBtn').show();                                 
                    $('.submitBtn').hide();
                    $('input, textarea').attr('readonly', true);
                    $('select, .entryBtn, .addVisitorBtn').attr('disabled', true);
                } 

                else if (securityEmail === "wjbastismo" && statusEmail === "Approved") {
                    $('.section').css('display', 'block');
                    $('.securityAss, .saveData').show();
                    $('.approveBtn, .submitBtn').hide();
                    $('input, textarea').attr('readonly', true);
                    $('.actualDateIn, .timeIn, .actualTimeOut').attr('readonly', false);
                    $('select, button').attr('disabled', true);
                    $('.saveData, .closeBtn').attr('disabled', false);
                }
                
                else {
                    $('.section').css('display', 'block');
                    $('.submitBtn, .saveData').hide();
                    $('input, textarea').attr('readonly', true);
                    $('select, button').attr('disabled', true);
                    $('.closeBtn').attr('disabled', false);
                }       

            });
        });    
    </script>
</body>
</html>