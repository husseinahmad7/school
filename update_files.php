<?php
session_start();
if($_SESSION["loginin"]!=true){
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/HW/login.php');
	exit;
}
if($_SESSION["loginin"]==true && $_SESSION["admin"]!=1){
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];
	header('Location: '.$uri.'/HW/main_library.php');
	exit;
}

//connecting to db
include_once 'dbConfig.php';

//getting file info
$myid = intval($_GET['id']);
$sSQL= 'SET CHARACTER SET UTF8';
$result = mysqli_query($conn, $sSQL);
$result = mysqli_query($conn, "SELECT * FROM school_pdf WHERE id='" . $myid . "'");
$row = mysqli_fetch_array($result);
$type = $row['type'];
$oldFile = $row['name'];
$oldPic = $row['file_pic'];
$message ='';

if (isset($_POST['update'])) { // if update button on the form is clicked
    // data of the new uploaded file
    $filename = $_FILES['updatedfile']['name'];
    $fileTitle = $_POST['updatedfiletitle'];
    $fileDesc = $_POST['updatedfiledesc'];
    $filePic = $_FILES['updatedfilepic']['name'];

    // destination of the file and pic on the server
    $destination = 'uploads/' . $filename;
    $picsDestination = 'uploadspics/' . $filePic;

    // get the file and pic extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $picsExtension = pathinfo($filePic, PATHINFO_EXTENSION);
    
    // the physical files on a temporary uploads directory on the server
    //if new file uploaded
    if ($filename != "") {
    $file = $_FILES['updatedfile']['tmp_name'];
    }
    //if new pic uploaded
    if ($filePic != "") {
    $filepic = $_FILES['updatedfilepic']['tmp_name'];
    }
    $size = $_FILES['updatedfile']['size'];

    //the type of updated file must be the same
    if (!in_array($extension, [$type,''])) {
        echo "You file extension must be " . $type;
    } elseif ($_FILES['updatedfile']['size'] > 10000000) { // file shouldn't be larger than 10 Megabyte
        echo "File too large!";
        echo "your file size must be less than 2 MB";
    } elseif (!in_array($picsExtension, ['JPG', 'png', 'JPEG', 'jpg',''])) {
        echo "You file extension must be JPG, png or JPEG";
    } else {
        // move the uploaded (temporary) file to the specified destination

        //if new file uploaded save new file on server and delete the old one
        if ($filename != "") {
            move_uploaded_file($file, $destination);
            unlink('uploads/' . $oldFile);
        } else {
            //else keep the old file
            $filename = $oldFile;
        }
        //if new pic uploaded save new pic on server and delete the old one
        if ($filePic != "") {
            move_uploaded_file($filepic, $picsDestination);
            unlink('uploadspics/' . $oldPic);
        } else {
            //else keep the old pic
            $filePic = $oldPic;
        }
        
        //update file info on db
        $sql = "UPDATE school_pdf SET name='$filename', size= $size, file_pic='$filePic' ,file_desc='$fileDesc' ,file_title='$fileTitle' WHERE id=$myid";
        if (mysqli_query($conn, $sql)) {
            $message = "تم تعديل الملف بنجاح";

            //updating file info in form with the new updated info
            $myid = intval($_GET['id']);
            $result = mysqli_query($conn, "SELECT * FROM school_pdf WHERE id='" . $myid . "'");
            $row = mysqli_fetch_array($result);
            $type = $row['type'];
            $oldFile = $row['name'];
            $oldPic = $row['file_pic'];

        } else {
            $message = "فشل تعديل الملف";
        }
    }
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- fontawesome -->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- stylesheets -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <title>تحديث المعلومات</title>
</head>

<body id="body" class="sb-nav-fixed">
<div>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.php">الصفحة الرئيسية</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="logout.php">تسجيل خروج</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">الصفحات</div>
                            <a class="nav-link" href="dashboard.php">
                                <i class="fas fa-tachometer-alt" style="margin-right: 10px;"></i>
                                لوحة التحكم
                            </a>
                            <a class="nav-link" href="admin_library.php">
                                <i class="fas fa-table" style="margin-right: 10px;"></i>
                                إدارة المكتبة
                            </a>
                            <a class="nav-link" href="main_library.php">
                                <i class="fas fa-table" style="margin-right: 10px;"></i>
                                مكتبة المستخدمين
                            </a>
                            <div class="sb-sidenav-menu-heading">الأدوات</div>
                            <a class="nav-link" href="insert_file.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                إضافة ملف جديد
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">تم تسجيل الدخول بصفتك</div>
                        Admin
                </nav>
            </div>
    <div class="container" id="layoutSidenav_content">
        <div class="row">
            <!-- form containing the old file info to edit the info -->
            <form accept-charset="utf-8" name="updateForm" class="updateForm" action="" method="post" enctype="multipart/form-data">
                <h3>تعديل الملف</h3>
                <label class="form-label" for="fileTitle">عنوان الملف</label>
                <input class="form-control" id="fileTitle" type="text" name="updatedfiletitle" value="<?php echo $row['file_title']; ?>"><br>

                <label class="form-label" for="fileDisc">وصف الملف</label>
                <input class="form-control" id="fileDisc" type="text" name="updatedfiledesc" value="<?php echo $row['file_desc']; ?>"><br>
                <label class="form-label" for="file">عدل الملف</label>
                <input class="form-control" id="file" type="file" name="updatedfile"><small class="form-text text-muted"><?php echo $row['name']; ?></small> <br><br>
                <label class="form-label" for="filePic">عدل صورة الملف</label>
                <input class="form-control" id="filePic" type="file" name="updatedfilepic"> <small class="form-text text-muted"><?php echo $row['file_pic']; ?></small><br><br>
                <button type="submit" class="btn btn-success" name="update" onclick="submitForm()">حفظ التعديلات</button><span id="message">   <?php echo $message; ?></span>
            </form>
            <script>
                function submitForm() {
                    
                    document.updateForm.submit();
                    
                }
            </script>
        </div>
    </div>
    <!-- bootstrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- script -->
    <script src="js/scripts.js"></script>
</body>

</html>