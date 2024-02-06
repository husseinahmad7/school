<!DOCTYPE html>
<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl">
<title>تسجيل الدخول</title>
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script>
function showUser(str) {
 if (str == "") {
 document.getElementById("txtHint").innerHTML = "";
 return;
 } else {

var xmlhttp = new XMLHttpRequest();
 xmlhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
    document.getElementById("txtHint").innerHTML = "الحسابات المقترحة: </br> "+this.responseText;
 }
 };
 xmlhttp.open("GET", "gethint.php?q=" + str, true);
 xmlhttp.send();
 document.getElementById("txtHint").classList.add("alert","alert-info");

}
}
</script>


<style>
.error {color: #FF0000;}
.nav-link {
  color: black !important;
}
.vh-100{
  height: 86vh !important;
}
</style>
</head>
<body style="	background: linear-gradient(90deg, #C7C5F4, #776BCC);	">
<?php
include "nav.php";
?>
<!--
mainpage شيك على الاسم اذا صحيح
تجريب شامل
validate password check
تعليقات
ربط قاعدة البيانات
AJAX
-->
<?php
// check if its logged in
if(isset($_SESSION["loginin"])&& isset($_SESSION["name"])) 
{
    if($_SESSION["loginin"]==true){
        echo '</br></br><div class="container mx-auto m-3">';

        echo "انت بالفعل قمت بتسجيل الدخول</br>".$_SESSION["name"]."</br>,يرجى <a href='logout.php'>تسجيل الخروج</a> اولا لتتمكن من تسجيل الدخول بحساب اخر";
        echo '</div>';
        return;
    }
}


$nameErr = $passwordErr="";
$name  = $password ="";
if(isset($_POST['name']) && isset($_POST['password']))
{

echo '<div class="alert alert-danger">';
if ($_SERVER["REQUEST_METHOD"] == "POST") {


if (empty($_POST["name"])) {
$nameErr = "ادخل إسم الطالب";
}
else{
    $nameErr = "";
}

if (empty($_POST["password"])) {
    $passwordErr = " ادخل الباسوورد";
}
else{
    $passwordErr = "";
   // validate password check
}

$name = $_POST['name'];
$password = $_POST['password'];
if( $nameErr  == "" && $passwordErr  == "" )
{


try {
  include_once 'dbConfig_PDO.php';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// check if name exist
$stmt = $conn->prepare("SELECT name,admin FROM accounts WHERE name=:name and password=:password");
$stmt->bindParam(':name', $name);
$stmt->bindParam(':password', $password);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows= $stmt->fetchAll();
if($rows == NULL){
  echo "</br></br></br><div class='alert alert-danger'>";
  echo "خطئ في كلمة المرور او الإسم";
  echo "</div>";
}
// double check..
foreach ( $rows as $row )
{
    if($row['name'] == $_POST['name'] && $row['name']!="" && $row['name']!= NULL)
    {// login in..
        $_SESSION["loginin"] = true;
        $_SESSION["name"] = $_POST['name'];
        $_SESSION["admin"] = $row["admin"];
        if($_SESSION["admin"]!=1){
          if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
          $uri = 'https://';
        } else {
          $uri = 'http://';
        }
        $uri .= $_SERVER['HTTP_HOST'];
        header('Location: '.$uri.'/HW/main_library.php');
        exit;
      }elseif($_SESSION["admin"]==1){
        if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
          $uri = 'https://';
        } else {
          $uri = 'http://';
        }
        $uri .= $_SERVER['HTTP_HOST'];
        header('Location: '.$uri.'/HW/dashboard.php');
        exit;

      }
        // echo '<div class="container mx-auto m-3 text-center">';
        // echo "تم تسجيل الدخول";
        // echo '<form action="main_library.php" method="post"><input type="submit" value="الذهاب للمكتبة"/></form>';
        // if($row['admin']){
        //     echo "</br> <a href='dashboard.php'> فتح لوحة المدير</a>";
        // }
        // echo '</div>';
        return;
    }
    else
    {
      echo '<script>window.alert("خطأ في كلمة السر أو الاسم")</script>';  
    }
}// end foreach
}//end try
 catch(PDOException $e)
{
 echo "Error: " . $e->getMessage();
}
$conn = null;

}
else{ 

//echo "يرجى الإنتباه للإخطاء الاتية:</br>";
}}
echo '</div>';}
?>

</br></br>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.webp"
          class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <fieldset>
        <form action="login.php" method="POST">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">

          <!--name input -->
          <div class="form-outline mb-4">
            <label class="form-label" for="name">الاسم</label>
            <input type="text" onchange="showUser(this.value)" name="name" id="name" value="<?= $name;?>" class="form-control form-control-lg"
              placeholder="ادخل الاسم" />
            <?php
            if($nameErr!=""){
            echo '<div class="alert alert-danger">';
            echo $nameErr;
            echo '</div>';}?>
          </div>
          </div>
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
          <!-- Password input -->
          <div class="form-outline mb-3">
            <label class="form-label" for="password">كلمة السر</label>
            <input type="password" name="password" id="password" value="<?php echo $password;?>" class="form-control form-control-lg"
              placeholder="ادخل كلمة السر" />
              <?php
            if($passwordErr!=""){
            echo '<div class="alert alert-danger">';
            echo $passwordErr;
            echo '</div>';}?>
          </div>
          </div>
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" value="تسجيل الدخول" />
            <p class="small fw-bold pt-1 mb-0 mt-3"> لا تملك حساب؟<a href="register.php"
                class="link-danger">انشاء حساب</a></p>
          </div>
          </div>
          <div class="" role="alert" id="txtHint"></div>

        </form>
        </fieldset>
      </div>
    </div>
  </div>
  <div
    class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary" style="margin-top: 27vh;">
    <!-- Copyright -->
    <div class="text-white mb-3 mb-md-0">
    جميع الحقوق محفوظة © 2022
    </div>
    <!-- Copyright -->

    <!-- Right -->
    <div>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="#!" class="text-white me-4">
        <i class="fab fa-google"></i>
      </a>
      <a href="#!" class="text-white">
        <i class="fab fa-linkedin-in"></i>
      </a>
    </div>
    <!-- Right -->
  </div>
</section>
</body>
</html>