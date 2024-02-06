<?php session_start(); ?>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top bluring">
  <div class="container-fluid">
    <a class="nav-link" href="index.php">مدرسة الأمل</a>
    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav mx-auto mb-2 mb-lg-0">
        <a class="nav-link active" aria-current="page" href="index.php">الرئيسية</a>
        <a id="lib" class="nav-link" href="main_library.php">المكتبة</a>
        <?php
        if(isset($_SESSION["loginin"]) && $_SESSION["loginin"]==true && isset($_SESSION["name"])) 
        {
          if(isset($_SESSION["admin"])&&$_SESSION["admin"]==1){
            echo '<a href="dashboard.php" class="nav-link">لوحة المدير</a>';

            echo "<a href='admin_library.php' class='nav-link'>إدارة المكتبة</a>";
            ?>
            <!-- <script>
              document.getElementById("lib").style.display="none";
            </script> -->
            <?php
          }
            echo "<a href='logout.php' class='nav-link'>تسجيل الخروج</a>";
        }else{
        echo "<a class='nav-link' href='login.php'>تسجيل الدخول</a>";
        echo "<a class='nav-link' href='register.php'>التسجيل</a>";
        
        }
        ?>

      </div>
    </div>
  </div>
</nav>