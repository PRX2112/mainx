<?php include 'header.php';
// session_start();
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
     .bodx::-webkit-scrollbar {
  display: none;
}
body{
    padding-top:150px;
}
</style>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body class="bodx">
<div class="container-fluid text-center">
<hr class="featurette-divider">

<!-- Three columns of text below the carousel -->
<div class="row my-5">
<div class=" mx-auto " >
        <input type="button" data-bs-toggle="dropdown" class=" btn btn-outline-dark" value="Login"/>
        <ul class="dropdown-menu  l" id="l">
            <li><a class="dropdown-item l" href="login.php?type=custx">Customer</a></li>
            <li><a class="dropdown-item l" href="login.php?type=servx">Service Provider</a></li>
        </ul>
        <!-- </div>&nbsp;&nbsp;
        <div > -->
        <input type="button" data-bs-toggle="dropdown" class="btn btn-dark" value="Register"/>
        <ul class="dropdown-menu r" id="r">
            <li><a class="dropdown-item r" href="Register.php?type=custx">Customer</a></li>
            <!-- <li><a class="dropdown-item r" href="Register.php?type=servx">Service Provider</a></li> -->
        </ul>
        </div>
</div>

<hr class="featurette-divider">

<!-- /END THE FEATURETTES -->

</div>
</body>
</html>      
<?php include 'footer.php';?>