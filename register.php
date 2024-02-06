<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["loginin"]))
{// Check the loginin value if it exists
    if($_SESSION["loginin"]==true){
        echo "</br></br>انت بالفعل قمت بتسجيل الدخول</br>".$_SESSION["name"]."
        </br>,يرجى <a href='logout.php'>تسجيل الخروج
        </a> اولا لتتمكن من صنع حساب جديد";
        return;//stop page loading
    }
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl">
<title>تسجيل طالب جديد</title>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<style>
.error {color: #B22222;}
</style>
</head>
<body style="	background: linear-gradient(90deg, #C7C5F4, #776BCC);	">

<?php 
include "nav.php";
//define varible
$nameErr = $year_birthdateErr = $month_birthdateErr = $day_birthdateErr = $genderErr =$languageErr=$levelErr=$father_nameErr=$mother_nameErr=$supervisorErr=$emailErr=$passwordErr=$phoneErr=$countryErr=$cityErr=$addressErr="";
$name  = $year_birthdate  = $month_birthdate  = $day_birthdate  = $gender  =$language= $canspeacklanguageErr=$level =$father_name =$mother_name =$supervisor =$email=$password =$phone =$country =$city =$address =$message="";

//define function that fix the input value
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// check input (check validate on serverside)
if(
    isset($_POST['name']) 
 && isset($_POST['year_birthdate'])
 && isset($_POST['month_birthdate'])
 && isset($_POST['day_birthdate'])
 && isset($_POST['gender'])
 && isset($_POST['language'])
 && isset($_POST['level'])
 && isset($_POST['father_name'])
 && isset($_POST['mother_name'])
 && isset($_POST['supervisor'])
 && isset($_POST['email'])
 && isset($_POST['phone'])
 && isset($_POST['country'])
 && isset($_POST['city'])
 && isset($_POST['address'] )

 )
 {

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Now check all input's and set error message if it's not validate or empty
        // student name
        if (empty($_POST["name"])) {
            $nameErr = "ادخل إسم الطالب";
        }
        else{
            $nameErr = "";
        }

        // year 
        if ($_POST["year_birthdate"]=="----") {
            $year_birthdateErr = "ادخل سنة الولادة";
        }
        else{
            $year_birthdateErr = "";
        }

        // mounth
        if ($_POST["month_birthdate"]=="----") {
            $month_birthdateErr = "أدخل شهر الولادة";
        }
        else{
            $month_birthdateErr = "";
        }

        // day
        if ($_POST["day_birthdate"]=="----") {
            $day_birthdateErr = "ادخل يوم الولادة";
        }
        else{
            $day_birthdateErr = "";
        }

        //gender
        if ($_POST["gender"]=="----") {
            $genderErr = "ادخل يوم الولادة";
        }
        else{
            $genderErr = "";
        }

        //language
        if ($_POST["language"] =="----") {
            $languageErr = "ادخل اللغة";
        }
        else{
            $languageErr = "";
        }

        //
        if ($_POST["canspeacklanguage"] =="----") {
            $canspeacklanguageErr = "هل يستطيع طفلك التحدث باللغة";
        }
        else{
            $canspeacklanguageErr = "";
        }

        //level
        if ($_POST["level"] == "----") {
            $levelErr = "ادخل المستوى";
        }
        else{
            $levelErr = "";
        }

        //father name
        if (empty($_POST["father_name"])) {
            $father_nameErr = " ادخل اسم الاب";
        }
        else{
            $father_nameErr = "";
        }

        //mother name
        if (empty($_POST["mother_name"])) {
            $mother_nameErr = " ادخل اسم الام";
        }
        else{
            $mother_nameErr = "";
        }

        //supervisor
        if ($_POST["supervisor"] == "----") {
            $supervisorErr = " ادخل المشرف";
        }
        else{
            $supervisorErr = "";
        }

        //phone number
        if (empty($_POST["phone"])) {
            $phoneErr = "ادخل رقم الهاتف";
        }
        else{
            $phoneErr = "";
        }

        //country
        if (empty($_POST["country"])) {
            $countryErr = " ادخل البلد";
        }
        else{
            $countryErr = "";
        }

        //city
        if (empty($_POST["city"])) {
            $cityErr = " ادخل المدينة";
        }
        else{
            $cityErr = "";
        }

        //address
        if (empty($_POST["address"])) {
            $addressErr = " ادخل العنوان";
        }
        else{
            $addressErr = "";
        }

        //password
        if (empty($_POST["password"])) {
            $passwordErr = " ادخل الباسوورد";
        }
        else{
            //validate password check
            if(strlen($_POST["password"])<=7){
                $passwordErr = " يجب أن يكون الباسوورد اطول من 8 محارف";
            }
            else{
                $passwordErr = "";
            }

        
        }
        // validate email check
        if(empty($_POST['email'])){
            $emailErr = " ادخل البريد الإلكتروني";
        }
        else {
            $emailErr = "";
            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "الإيميل المدخل غير صالح";
            }
            else{
                $emailErr = "";
            }//end
        }//end else (!empty($_POST['email'])
}//REQUEST_METHOD



// define varible contain POST values
$name = $_POST['name'];
$year_birthdate = $_POST['year_birthdate'];
$month_birthdate = $_POST['month_birthdate'];
$day_birthdate = $_POST['day_birthdate'];
$gender = $_POST['gender'];
$language = $_POST['language'];
$canspeacklanguage = $_POST['canspeacklanguage'];
$level = $_POST['level'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];
$supervisor = $_POST['supervisor'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$city = $_POST['city'];
$address = $_POST['address'];
$message = $_POST['message'];
$password = $_POST['password'];
$ip = $_SERVER['REMOTE_ADDR'];
$isProblem = false;// to prevent database connecting (if there is any problem we will change it to true)
//check if is there any error message
if(
   $nameErr  == ""
&& $year_birthdateErr  == "" 
&& $month_birthdateErr  == "" 
&& $day_birthdateErr  == ""
&& $genderErr  == ""
&& $languageErr == ""
&& $levelErr == ""
&& $father_nameErr == ""
&& $mother_nameErr == ""
&& $supervisorErr == ""
&& $emailErr == ""
&& $phoneErr == ""
&& $countryErr == ""
&& $cityErr == ""
&& $addressErr == "")
{

//get database information
include_once 'dbConfig_PDO.php';
try {
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// check if name exist in DB
$stmt = $conn->prepare("SELECT name,email FROM accounts WHERE name=:name");
$name = $_POST['name'];
$stmt->bindParam(':name', $name);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows= $stmt->fetchAll();
// if exist stop login in
foreach ( $rows as $row )
{
    if($row['name'] == $_POST['name'])
    {
        echo "</br></br>الإسم موجود بالفعل ,إيميل الحساب [".$row['email']."] </br> <a class='alert alert-warning' role='alert' href='login.php'>إضغط لتسجيل الدخول</a>";
        $isProblem=true;
    }
    else
    {
        break;
    }
}



if(!$isProblem){
// start create new account
 $stmt = $conn->prepare("INSERT INTO `accounts`(`name`, `year_birthdate`, `month_birthdate`, `day_birthdate`, `gender`, `language`, `canspeacklanguage`, `level`, `father_name`, `mother_name`, `supervisor`, `email`, `phone`, `country`, `city`, `address`, `message`, `password`, `ip`)
 VALUES (:name, :year_birthdate, :month_birthdate,:day_birthdate, :gender, :language,:canspeacklanguage,:level, :father_name, :mother_name,:supervisor, :email, :phone, :country, :city, :address, :message, :password, :ip)");
 // prevent sql injection
 $stmt->bindParam(':name', $name);
 $stmt->bindParam(':year_birthdate', $year_birthdate);
 $stmt->bindParam(':month_birthdate', $month_birthdate);
 $stmt->bindParam(':day_birthdate', $day_birthdate);
 $stmt->bindParam(':gender', $gender);
 $stmt->bindParam(':language', $language);
 $stmt->bindParam(':canspeacklanguage', $canspeacklanguage);
 $stmt->bindParam(':level', $level);
 $stmt->bindParam(':father_name', $father_name);
 $stmt->bindParam(':mother_name', $mother_name);
 $stmt->bindParam(':supervisor', $supervisor);
 $stmt->bindParam(':email', $email);
 $stmt->bindParam(':phone', $phone);
 $stmt->bindParam(':country', $country);
 $stmt->bindParam(':city', $city);
 $stmt->bindParam(':address', $address);
 $stmt->bindParam(':message', $message);
 $stmt->bindParam(':password', $password);
 $stmt->bindParam(':ip', $ip);
 $stmt->execute();
 echo "</br></br>تم إنشاء حساب بنجاح !";
 echo '<form action="login.php" method="post"><input type="submit" value="الإستمرار لتسجيل الدخول"/></form>';
 return ;
}// end if(isProblem)
}//end try
 catch(PDOException $e)
{
 echo "Error: " . $e->getMessage();
}
$conn = null;

}
else{
echo "<div class='alert alert-warning' role='alert'></br></br>يرجى الإنتباه للإخطاء الاتية:</br>";
echo "</br></br>". $nameErr ;echo " ". $year_birthdateErr ;echo " 
". $month_birthdateErr ;echo " ". $day_birthdateErr ;echo "
 ". $genderErr ;echo " ".$languageErr;echo "
  ".$levelErr;echo " ".$father_nameErr;echo "
   ".$mother_nameErr;echo " ".$supervisorErr;echo "
    ".$emailErr;echo " ".$phoneErr;echo "
     ".$countryErr;echo " ".$cityErr;echo "
      ".$addressErr;echo "</div>";
}



}// end if(check input)


?>
</br></br>
<form action="register.php" method="post">
    <div class="container">
        <fieldset>
            <legend>تسجيل طفل جديد</legend>
            <div class="mb-3">
                <label class="form-label" for="name">اسم الطفل كاملا *</label>
                 <input class="form-control" type="text" name ="name" id="name" value="<?= $name;?>" />
                <span class="error"><?php echo $nameErr;?></span>

            </div>
            <p>تاريخ الولادة *</p>
            <div class="m-3 row">
                <div class="col">
                    <label class="form-label" for="year_birthdate"> السنة</label>
                    <select class="form-select" name="year_birthdate" id="year_birthdate">
                    <option value="----" selected>----</option>
                    <option value="2001">2001</option>
                    <option value="2002">2002</option>
                    <option value="2003">2003</option>
                    <option value="2004">2004</option>
                    <option value="2005">2005</option>
                    <option value="2006">2006</option>
                    <option value="2007">2007</option>
                    <option value="2008">2008</option>
                    <option value="2009">2009</option>
                    <option value="2010">2010</option>
                    <option value="2011">2011</option>
                    <option value="2012">2012</option>
                    <option value="2013">2013</option>
                    <option value="2014">2014</option>
                    <option value="2015">2015</option>
                    <option value="2016">2016</option>
                    <option value="2017">2017</option>
                    <option value="2018">2018</option>
                    <option value="2019">2019</option>
                    <option value="2020">2020</option>
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    </select>
                    <span class="error"><?php echo $year_birthdateErr;?></span>
                    <script type="text/javascript">
                        var theValue = "<?= $year_birthdate; ?>";
                        if (theValue != '') {
                            document.getElementById('year_birthdate').value = theValue;
                        }
                    </script>
                </div>
                <div class="col">
                    <label class="form-label" for="month_birthdate"> الشهر</label>
                    <select class="form-select" name ="month_birthdate" id="month_birthdate">
                    <option value="----" selected>----</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    </select>
                    <span class="error"><?php echo $month_birthdateErr;?></span>
                    <script type="text/javascript">
                        var theValue = "<?= $month_birthdate; ?>";
                        if (theValue != '') {
                            document.getElementById('month_birthdate').value = theValue;
                        }
                    </script>
                </div>
                <div class="col">
                    <label class="form-label" for="day_birthdate"> اليوم</label>
                    <select class="form-select" name ="day_birthdate" id="day_birthdate">
                    <option value="----" selected>----</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                    <option value="31">31</option>
                    </select>
                    <span class="error"><?php echo $day_birthdateErr;?></span>
                    <script type="text/javascript">
                        var theValue = "<?= $day_birthdate; ?>";
                        if (theValue != '') {
                            document.getElementById('day_birthdate').value = theValue;
                        }
                    </script>
                </div>
                
            </div>
            <div class="mb-3">
                <label class="form-label" for="gender">جنس الطفل *</label>
                <select class="form-select" name ="gender" id="gender">
                <option value="----" selected>----</option>
                <option value="0">ذكر</option>
                <option value="1">انثى</option>
                </select>
                <span class="error"><?php echo $genderErr;?></span>
                <script type="text/javascript">
                    var theValue = "<?= $gender; ?>";
                    if (theValue != '') {
                        document.getElementById('gender').value = theValue;
                    }
                </script>
            </div>
            <div class="mb-3">
                <label class="form-label" for="language">اختر اللغة التي ترغب بتعليمها لطفلك *</label>
                <select class="form-select" name="language" id="language">
                <option value="----" selected>----</option>
                <option value="0">العربية</option>
                <option value="1">الإنجليزية</option>
                </select>
                <span class="error"><?php echo $languageErr;?></span>
                <script type="text/javascript">
                    var theValue = "<?= $language; ?>";
                    if (theValue != '') {
                        document.getElementById('language').value = theValue;
                    }
                </script>
            </div>
            <div class="mb-3">
                <label class="form-label" for="canspeaklanguage">هل يستطيع طفلك التحدث بها؟ *</label>
                <select class="form-select" name ="canspeacklanguage" id="canspeacklanguage">
                <option value="----" selected>----</option>
                <option value="0">لا</option>
                <option value="1">نعم</option>
                </select>
                <span class="error"><?php echo $canspeacklanguageErr;?></span>
                <script type="text/javascript">
                    var theValue = "<?= $canspeacklanguage; ?>";
                    if (theValue != '') {
                        document.getElementById('canspeacklanguage').value = theValue;
                    }
                </script>
            </div>
            <div class="mb-3">
                <label class="form-label" class="form-label" for="level">ما مستواه؟ *</label>
                <select class="form-select" name ="level" id="level">
                <option value="----" selected>----</option>
                <option value="0">مبتدئ</option>
                <option value="1">متوسط</option>
                <option value="2">جيد</option>
                </select>
                <span class="error"><?php echo $levelErr;?></span>
                <script type="text/javascript">
                    var theValue = "<?= $level; ?>";
                    if (theValue != '') {
                        document.getElementById('level').value = theValue;
                    }
                </script>
            </div>
            <div class="mb-3">
                <label class="form-label" for="father_name">اسم الأب كاملا *</label>
                <input class="form-control" type="text" name ="father_name" id="father_name" value="<?php echo $father_name;?>"/>
                <span class="error"><?php echo $father_nameErr;?></span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="mother_name">اسم الأم كاملا *</label>
                <input class="form-control" type="text" name ="mother_name" id="mother_name" value="<?php echo $mother_name;?>"/>
                <span class="error"><?php echo $mother_nameErr;?></span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="supervisor">المشرف *</label>
                <select class="form-select" name ="supervisor" id="supervisor">
                <option value="----" selected>----</option>
                <option value="0">الأب</option>
                <option value="1">الأم</option>
                <option value="2">الأم والأب</option>
                </select>
                <span class="error"><?php echo $supervisorErr;?></span>
                <script type="text/javascript">
                    var theValue = "<?= $supervisor; ?>";
                    if (theValue != '') {
                        document.getElementById('supervisor').value = theValue;
                    }
                </script>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">الإيميل *</label>
                <input class="form-control" type="text" name ="email" id="email" value="<?php echo $email;?>"/>
                <span class="error"><?php echo $emailErr;?></span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="password">الباسوورد *</label>
                <input class="form-control" type="password" name ="password" id="password" value="<?php echo $password;?>"/>
                <span class="error"><?php echo $passwordErr;?></span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="phone">الهاتف مع الرمز الدولي *</label>
                <input class="form-control" type="text" name ="phone" id="phone" value="<?php echo $phone;?>"/>
                <span class="error"><?php echo $phoneErr;?></span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="country">البلد المقيم فيها حالياً *</label>
                <input class="form-control" type="text" name ="country" id="country" value="<?php echo $country;?>"/>
                <span class="error"><?php echo $countryErr;?></span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="city">المدينة المقيم فيها حالياً *</label>
                <input class="form-control" type="text" name ="city" id="city" value="<?php echo $city;?>"/>
                <span class="error"><?php echo $cityErr;?></span>
            </div>
            <div class="mb-3">
                <label  class="form-label" for="adress">عنوان سكن الطفل بالتفصيل*</label>
                <textarea class="form-control" cols="20" rows="8" name ="address" id="address"><?php echo $address;?></textarea>
                <span class="error"><?php echo $addressErr;?></span>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">رسالتك أو سؤالك للمدرسة</label>
                <textarea class="form-control" cols="20" rows="8" name ="message" id="message"><?php echo $message;?></textarea>
            </div>
</br>
<input class="btn btn-primary" type="submit" value="فتح حساب طالب جديد"/>
        </fieldset>
    </div>

</form>
<?php include 'footer.php'; ?>
</body>
</html>