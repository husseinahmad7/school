<!DOCTYPE html>
<?php
session_start();

function logout(){
    if(isset($_SESSION["loginin"]) && $_SESSION["loginin"]==true && isset($_SESSION["name"])) 
{
    if($_SESSION["loginin"]==true){
    $_SESSION["name"] = "";
    $_SESSION["loginin"] = false;
    $_SESSION["admin"] = "";
    
    echo "تم تسجيل الخروج ,";
    echo "<a class='link-primary' href='login.php'>إضغط هنا لتسجيل الدخول</a>";
    echo "<br /><a class='link-primary' href='index.php'>اضغط هنا للانتقال للصفحة الرئيسية</a>";
        return;
    }
}
else
{
    echo "لم يتم تسجيل الدخول, ";
    echo "<a class='link-primary' href='login.php'>إضغط هنا لتسجيل الدخول</a>";
    echo "<br /><a class='link-primary' href='index.php'>اضغط هنا للانتقال للصفحة الرئيسية</a>";
}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl">
<title>تسجيل الخروج</title>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<style>
.error {color: #FF0000;}
</style>
</head>
<body>
    <div class="alert alert-secondary" role="alert">
        <?php
        logout(); ?>
    </div>
</body>
</html>