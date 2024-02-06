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
if (!isset($_SESSION["admin"]) || $_SESSION["admin"] != 1) {
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];
    header('Location: ' . $uri . '/HW/main_library.php');
    exit;
};

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>لوحة التحكم</title>
    <!-- adding bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- add css file -->
    <link href="css/dashboard.css" rel="stylesheet" />
    <!-- add fontawesome for icons -->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
</head>

<body class="sb-nav-fixed">
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
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            لوحة التحكم
                        </a>

                        <a class="nav-link" href="admin_library.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            إدارة المكتبة
                        </a>
                        <div class="sb-sidenav-menu-heading">الأدوات</div>

                        <a class="nav-link" href="insert_file.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            أضف ملف جديد
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <?php if ($_SESSION["loginin"] == true) {
                        echo '<div class="small">تم تسجيل الدخول بصفتك</div>';
                        echo $_SESSION["name"];
                    }
                    ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">لوحة التحكم</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"></li>
                    </ol>
                    <div class="row">
                        <?php
                        //Getting Downloads Numbers and calculate sum of it for each data type from Database
                        //to show it in dashboard
                        include_once 'dbConfig.php';

                        $book_result = mysqli_query($conn, "SELECT downloads FROM school_pdf WHERE type='" . "pdf" . "'");
                        $song_result = mysqli_query($conn, "SELECT downloads FROM school_pdf WHERE type='" . "mp3" . "'");
                        $video_result = mysqli_query($conn, "SELECT downloads FROM school_pdf WHERE type='" . "mp4" . "'");
                        $my_books = [];
                        $my_songs = [];
                        $my_videos = [];
                        $i = 0;
                        $j = 0;
                        $e = 0;
                        while ($book_row = $book_result->fetch_assoc()) {
                            foreach ($book_row as $book) {
                                $my_books[$i] = intval($book);
                                $i++;
                            }
                        }
                        while ($song_row = $song_result->fetch_assoc()) {
                            foreach ($song_row as $song) {
                                $my_songs[$j] = intval($song);
                                $j++;
                            }
                        }
                        while ($video_row = $video_result->fetch_assoc()) {
                            foreach ($video_row as $video) {
                                $my_videos[$e] = intval($video);
                                $e++;
                            }
                        }
                        ?>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body"><i class="fa fa-book" style="margin-right: 10px;"></i>تحميلات الكتب</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span id="my-downloads">
                                        <!-- downloads number from db -->
                                        <?php print(array_sum($my_books)); ?>
                                    </span>
                                    <a class="small text-white stretched-link" href="admin_library.php">إدارة المكتبة</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-body"><i class="fa fa-music" style="margin-right: 10px;"></i>تحميلات الأغاني</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span id="my-downloads">
                                        <?php print(array_sum($my_songs)); ?></span>
                                    <a class="small text-white stretched-link" href="admin_library.php">إدارة المكتبة</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body"><i class="fa fa-video" style="margin-right: 10px;"></i>تحميلات الفيديوهات</div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <span id="my-downloads">
                                        <?php print(array_sum($my_videos)); ?></span>
                                    <a class="small text-white stretched-link" href="admin_library.php">إدارة المكتبة</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    التمثيل البياني لجنس الطلاب
                                </div>
                                <!-- pie chart(see js file) -->
                                <div class="card-body"><canvas id="myPieChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    التمثيل البياني لعمر الطلاب
                                </div>
                                <!-- bar chart (see js file) -->
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            معلومات الطلاب
                        </div>
                        <div class="card-body">
                            <!-- data table for student information using datatable simple (see js file) -->
                            <table id="datatablesSimple" class="table table-striped">


                                <?php
                                //select all students from db
                                include_once 'dbConfig.php';
                                $sql = 'SELECT * from accounts';
                                if (mysqli_query($conn, $sql)) {
                                    echo "";
                                } else {
                                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                }
                                $count = 1;
                                $result = mysqli_query($conn, $sql);
                                ?>
                                <thead>
                                    <tr>
                                        <th>المعرف</th>
                                        <th>الاسم</th>
                                        <th>الميلاد</th>
                                        <th>الجنس</th>
                                        <th>المستوى</th>
                                        <th>اللغة</th>
                                        <th>الايمييل</th>
                                        <th>كلمة السر</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>المعرف</th>
                                        <th>الاسم</th>
                                        <th>الميلاد</th>
                                        <th>الجنس</th>
                                        <th>المستوى</th>
                                        <th>اللغة</th>
                                        <th>الايميل</th>
                                        <th>كلمة السر</th>
                                    </tr>
                                </tfoot>
                                <!-- output student info in table for each student -->
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {

                                        // age and gender arrays to get age and gender info for charts
                                        $age = [];
                                        $gender = [];
                                        while ($row = mysqli_fetch_assoc($result)) {

                                            if ($row['admin'] == 0) {

                                    ?>
                                                <tr>
                                                    <th>
                                                        <?php echo $row['id']; ?>
                                                    </th>
                                                    <td>
                                                        <?php echo $row['name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php $birth = $row['year_birthdate'];

                                                        // calculate student age and store it in age array
                                                        array_push($age, (2022 - intval($birth)));

                                                        echo $row['day_birthdate'] . "/" .
                                                            $row['month_birthdate'] . "/" .
                                                            $row['year_birthdate'];  ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $my_gender = $row['gender'];


                                                        if ($my_gender == 0) {
                                                            $g = "Male";
                                                            echo $g;
                                                            //store student gender in gender array
                                                            array_push($gender, $g);
                                                        } else {
                                                            $g = "Female";
                                                            echo "Female";
                                                            array_push($gender, $g);
                                                        }


                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['level']; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['language'] == 0) {
                                                            echo "العربية";
                                                        } else {
                                                            echo "الانكليزية";
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['email']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['password']; ?>
                                                    </td>
                                                </tr>
                                    <?php
                                                $count++;
                                            }
                                        }
                                    } else {
                                        echo 'لا نتيجة';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">الحقوق محفوظة &copy; sch-lib 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <!-- charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript">
        //create age and gender arrays in js to transfer info from server to js files
        var age = [];
        var gender = [];
        <?php foreach ($age as $ageitem) { ?>
            age.push("<?= $ageitem ?>");
        <?php  } ?>
        <?php foreach ($gender as $genderitem) { ?>
            gender.push("<?= $genderitem ?>");
        <?php  } ?>

        console.log(gender[0]);
    </script>
    <!-- charts scripts -->
    <script src="js/chart-bar-demo.js"></script>
    <script src="js/chart-pie-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="js/datatables.js"></script>
</body>

</html>