<?php
session_start();
  if (isset($_SESSION['ingreso']) && $_SESSION['ingreso']=='YES' && $_SESSION['profesor'] == "YES") 
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Configuracion de cuenta de instructor</title>
    <!--=========================================  Links CSS ======================================================-->
    <link rel="shortcut icon" href="../../src/img/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../src/css/normalize.css">
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/icons/all.css">
    <!-- <link rel="stylesheet" href="../../src/css/bootstrap.css"> -->
   

</head>
<body>
<div class="contenedor active" id="contenedor">
        <?php   require '../includes/header.php'?>

         <?php  require '../includes/sidebar.php'?>

        <main class="main">
          <?php require '../includes/accout_rol.php'?>
        </main>

        
      
</div>
     <!--============================================= SRC JS ==================================================-->
    
     <script src="../../src/js/axios.min.js"></script>
     <script src="../../src/js/vue.js"></script>
     <!-- <script src="https://momentjs.com/downloads/moment-with-locales.min.js"></script> -->
     <script src="../../src/js/profesor_plataform.js"></script>
     <script src="../../src/js/menu.js"></script>
     <script src="../../src/js/profile.js"></script>
     <script>
            
     </script>

     <!-- <script src="../../src/js/jquery-3.5.1.min.js"></script> -->
</body>
</html>
<?php
  }
  else
  {
    header("location: ../../public/login.html");
  }
 ?>