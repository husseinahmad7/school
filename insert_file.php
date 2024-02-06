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

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- add bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- add fontawesome -->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- stylesheets -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style.css">
    <!-- add jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
    <title>تحميل ملف</title>

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
                    <!--form to insert new file -->
                    <form class="insert-form" name="insert-form" action="" method="post" enctype="multipart/form-data">
                        <h3>إضافة ملف جديد</h3>
                        <label class="form-label" for="fileTitle">عنوان الملف</label>
                        <input class="form-control" id="fileTitle" type="text" name="filetitle"><br>
                        <label class="form-label" for="fileDisc">وصف الملف</label>
                        <input class="form-control" id="fileDisc" type="text" name="filedesc"><br>
                        <label class="form-label" for="file">قم بتحميل الملف</label>
                        <input class="form-control" id="file" type="file" name="myfile">
                        <small id="passwordHelpBlock" class="form-text text-muted">
                            pdf أو mp3 أو mp4 لاحقة ملفك يجب أن تكون
                        </small><br><br>
                        <label class="form-label" for="filePic">قم بتحميل صورة للملف</label>
                        <input class="form-control" id="filePic" type="file" name="filepic"><br>
                        <button class="btn btn-success" type="submit" name="save" onclick="submitForm()">إضافة الملف</button><span id="message"> <?php
                                                                                                                                                    //showing success or error meesage on submition
                                                                                                                                                    include 'filesLogic.php'; ?></span>
                    </form>
                    <script>
                        function submitForm() {
                            document.insert - form.submit();
                            document.insert - form.reset();
                        }
                    </script>
                </div>
            </div>
            <!-- bootstrap script -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
            <script src="js/scripts.js"></script>

</body>

</html>