<?php 
  // require "login/loginheader.php"; 
  // require "config/db_config.php"; 
  // require "config/global_config.php"; 
  session_start();
  if (isset($_SESSION['login']))
  {
    // logged_in_msg($username);
  }
  else {
      header('Location: login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>ServerMail</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--   <script src="config/config.js"></script>
  <script src="vmmain.js"></script> -->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <style type="text/css">
    .header-bar {}
  </style>



</head>
<body>
  <div class="container">
    <div class="page-header">
    <h1><span class="text-success">ServerMail</span></h1>

    </div>
  <div class="content">
  <div class="row header-bar">
    <div class="col-sm-9"></div>
    <div class="col-sm-2"><a href="login.php?logout=1" class="btn btn-info btn-block">Logout</a></div>
    <div class="col-sm-1"></div>
  </div>
    <!-- end title and log out -->
    <div class="row"> <!-- page start -->
      <div class="col-sm-3"> <!-- navigation bar -->
        <div class="list-group btn-lg" style="padding : 10% 0 0 0;">

           <a id="mail-page-nav-btn" href="#" class="nav-btn list-group-item">Password and Emails</a>
           <a id="alias-page-nav-btn" href="#" class="nav-btn list-group-item">Alias</a>
           <a id="domain-page-nav-btn" href="#" class="nav-btn list-group-item">Domain</a>
           <!-- <a id="domain-page-nav-btn" href="#" class="nav-btn list-group-item">domain</a> -->

        </div> <!--end naviation  -->

      </div> <!-- end left column -->
      
      <div class="col-sm-9">       <!-- start right column  -->


        <div id="right-area">
        </div>

      </div> <!-- end right column -->
    
    </div> <!-- page end -->

  </div>  <!-- end container -->
  
  </div>

</body>
</html>
<script>
          // var loading_div = $("#loading-div");
          // var building_div = $("#building-div");
          // loading_div.hide();
          // building_div.hide();
            $("#mail-page-nav-btn").click(function(){
               var me  = $(this);
               $(".list-group-item").removeClass("active");
               me.addClass("active");
               var url = "mail.php";
               nav_item_click(me, url);
            }); 

            $("#alias-page-nav-btn").click(function(){
               var me  = $(this);
               $(".list-group-item").removeClass("active");
               me.addClass("active");
               var url = "alias.php";
               nav_item_click(me, url);
            }); 

            $("#domain-page-nav-btn").click(function(){
               var me  = $(this);
               $(".list-group-item").removeClass("active");
               me.addClass("active");
               var url = "domain.php";
               nav_item_click(me, url);
            }); 

            
            var right_area = $("#right-area");
           
            function nav_item_click(obj,url) 
            {
                $.ajax({
                    url: url,
                    type: "get",
                    success: function(data){
                      right_area.html(data);
                    }
                });
            }

            $.ajax({
                    url: "mail.php",
                    type: "get",
                    success: function(data){
                      right_area.html(data);
                    }
                });

</script>




