<?php

require_once 'class.php';



$session = new sessionManage();
$logged_in = $session->checkIsLoggedIn(true, '' . configAndConnect::URL . 'login/');

$is_activated = $session->IsAccountActivated();
if ($is_activated) {//Account is activated
    $user_details = new accountDetails();
    $user_details_array = $user_details->accountData();//Array for user account details
}else{
    exit("Not activated");
}
require_once 'config.php';
require_once 'vendor/sql.php';
$dbNEW = new MysqliDb ($server, $user, $pw, $db);



$userID = $user_details_array['uid'];

$dbNEW->where ("userid", $userID);
$todoDB = $dbNEW->getOne("things_todo");

if($dbNEW->count < 1)
{
    //NIX GEFUNDEN, dann lass mal generieren!
    $dataGenerate = Array ("userid" => $userID,
               "lastrequest" => "2020-06-11 13:32:20",
               "secret" => substr(md5(microtime()),rand(0,26),35)
);

if(!$dbNEW->insert ('things_api', $dataGenerate)){
    exit("ERROR: Contact Support");
}

echo "<meta http-equiv='refresh' content='0;url=index.php'>";


    $dataGenerate2 = Array ("userid" => $userID,
               "inbox" => "[]",
               "everyday" => "[]",
               "someday" => "[]",
               "lastapi" => "2020-06-11 13:32:20"
);
if(!$dbNEW->insert ('things_todo', $dataGenerate2)){
    exit("ERROR: Contact Support");
}

echo "<meta http-equiv='refresh' content='0;url=index.php'>";




}


$arrayInbox = json_decode($todoDB["inbox"], true);
$arrayToday = json_decode($todoDB["today"], true);
$arrayEveryday = json_decode($todoDB["everyday"], true);
$arraySomeday = json_decode($todoDB["someday"], true);

$lastUpdate = $todoDB["lastapi"];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>All my things in the web</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/Nunito%20Sans.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/Navbar-Centered-Brand-icons.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-light navbar-expand-md bg-light py-3">
                    <div class="container-fluid"><a class="navbar-brand d-flex align-items-center" href="#"><span class="bs-icon-sm bs-icon-rounded bs-icon-primary d-flex justify-content-center align-items-center me-2 bs-icon"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-check-circle">
                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"></path>
                                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"></path>
                                </svg></span><span>ALL MY THINGS</span></a><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-4"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse flex-grow-0 order-md-first" id="navcol-4">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item"><a class="nav-link active" href="#" data-bs-target="#imprint" data-bs-toggle="modal">LEGAL</a></li>
                                <li class="nav-item"></li>
                                <li class="nav-item"><a class="nav-link" href="./logout">LOGOUT</a></li>
                            </ul>
                            <div class="d-md-none my-2"><button class="btn btn-light me-2" type="button">Button</button><button class="btn btn-primary" type="button">Button</button></div>
                        </div>
                        <div class="d-none d-md-block"><button class="btn btn-light me-2" type="button" data-bs-target="#install" onclick="alert('If your hosting this application on your server, please READ the yellow alert-box');" data-bs-toggle="modal">How to install&nbsp;</button><a class="btn btn-primary" role="button" href="#" data-bs-target="#addtodo" data-bs-toggle="modal">+</a></div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col"></div>
            <div class="col"></div>
            <div class="col-md-6 col-lg-12" style="margin-top: 29px;">
                <div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation"><a class="nav-link active" role="tab" data-bs-toggle="tab" href="#tab-1">Inbox&nbsp;<i class="fas fa-inbox text-center" style="color: var(--bs-blue);"></i></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-2">Today&nbsp;<i class="far fa-star" style="color: var(--bs-yellow);"></i></a></li>
                        <!-- <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-3">Planned&nbsp;<i class="far fa-calendar-alt" style="color: var(--bs-red);"></i></a></li> -->
                        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-4">Everyday&nbsp;<i class="fas fa-bars" style="color: var(--bs-success);"></i></a></li>
                        <li class="nav-item" role="presentation"><a class="nav-link" role="tab" data-bs-toggle="tab" href="#tab-5">Someday <i class="fas fa-box-open" style="color: var(--bs-yellow);"></i></a></li>
                    </ul>
                    <div class="tab-content" style="margin-top: 15px;">
                        <div class="tab-pane fade show active" role="tabpanel" id="tab-1">
                            <ul>

                                <?php
                                foreach ($arrayInbox as $item)
                                {
                                echo '<li>'.$item.'</li>';    
                                }

                                ?>


                            </ul>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="tab-2">
                              <ul>

                                <?php
                                foreach ($arrayToday as $item)
                                {
                                echo '<li>'.$item.'</li>';    
                                }

                                ?>


                            </ul>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="tab-3">
                              <ul>

                              


                            </ul>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="tab-4">
                             <ul>

                                <?php
                                foreach ($arrayEveryday as $item)
                                {
                                echo '<li>'.$item.'</li>';    
                                }

                                ?>


                            </ul>
                        </div>
                        <div class="tab-pane fade" role="tabpanel" id="tab-5">
                             <ul>

                                <?php
                                foreach ($arraySomeday as $item)
                                {
                                echo '<li>'.$item.'</li>';    
                                }

                                ?>


                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <p><em><span style="color: rgb(143, 144, 145);">Last Update: <?php echo $lastUpdate; ?></span></em></p>
            </div>
        </div>
    </div>
    <div class="modal fade pulse animated" role="dialog" tabindex="-1" id="install">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">INSTALLATION PROCESS</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
<p>
Installation:
 <br>
 <ul>
<li> Download the shortcut to your iPhone (<a href="https://www.icloud.com/shortcuts/54c397c9caef49d0a9538fc88d8c015c" target="_blank">DOWNLOAD HERE</a>) </li> 
<li> Edit the shortcut and replace "SECRET-CODE-HERE" with your secret key, which is: <u><strong><?php
$dbNEW->where ("userid", $userID);
$todoDB = $dbNEW->getOne("things_api");
echo $todoDB["secret"];
?></strong></u></li> 
<li> Now create an automation in the Shortcuts app and select "Time of day", now you can set a time when the shortcut should be executed (e.g. 11 am) (Repeat daily). </li> 
<li> Add an "Action" and select "Execute shortcut".</li> 
<li> There you can select the downloaded shortcut.</li> 

</ul><br>
You can repeat this process as often as you like (e.g. if you want to execute the command every hour, you need a separate "Automation" for every hour), but ALWAYS choose THE SAME shortcut.
<br>
You can now test the whole thing again by manually executing the shortcut once and then updating the interface here.
<br>
<br>
<div class="alert alert-warning" role="alert">
  Are you hosting this on your own server? Then you still need to edit the shortcut as follows: Scroll down to the bottom of the shortcut code and edit "Get content from URL" by replacing the domain with your own, this must point to the "api.php" on your server.
  <br>
  So if your you accessing this webpage on https://yourcooldomain.com/ then the api-url is https://yourcooldomain.com/api.php
</div>


</p>


                  
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">DID IT</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="imprint">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">IMPRINT</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Soon</p>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Close</button></div>
            </div>
        </div>
    </div>
    <div class="modal fade" role="dialog" tabindex="-1" id="addtodo">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">ADD NEW TODO</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form><input class="form-control" type="text" disabled="disabled" value="COMING SOON" placeholder="Buy milk"></form>
                </div>
                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">CLOSE</button><button class="btn btn-primary" type="button">ADD</button></div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
</body>

</html>
