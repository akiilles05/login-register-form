 <?php
    //entry.php  
    session_start();
    if (!isset($_SESSION["username"])) {
        header("location:login.php");
    }
    ?>
 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Felhasználói Fiók</title>
     <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

     <style>
         body {
             display: grid;
             place-items: center;
             text-align: center;
             height: 100vh;
             margin: 0;
             background-color: #1c64f2;
             color: white;
         }
     </style>
 </head>

 <body class="grid place-items-center bg-blue-700">
     <div class="">
         <h3 class="text-lg">Felhasználói fiók</h3>
         <br /><br />
         <div>
             <?php
                echo '<h1 class="text-2xl">Szia - ' . $_SESSION["username"] . '</h1>';
                ?>
         </div>

     </div>

     <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
 </body>

 </html>