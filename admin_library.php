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

include 'filesLogic.php';

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- adding bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="css/dashboard.css" rel="stylesheet" />
    
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- adding jquery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>صفحة الإدارة</title>
    <link rel="stylesheet" href="css/AdminLibrary.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
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
                            <a class="nav-link" href="main_library.php">
                                <i class="fas fa-table" style="margin-right: 10px;"></i>
                                مكتبة المستخدمين
                            </a>
                            <!-- Nav tabs -->
                        <div class="sb-sidenav-menu-heading">الملفات</div>
                        
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                        
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active" id="books-tab" data-bs-toggle="tab" data-bs-target="#books" type="button" role="tab" aria-controls="books" aria-selected="true"><i class ="fa fa-book" style="margin-right: 10px;"></i>الكتب</a>
                        </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link" id="songs-tab" data-bs-toggle="tab" data-bs-target="#songs" type="button" role="tab" aria-controls="songs" aria-selected="false"><i class ="fa fa-music" style="margin-right: 10px;"></i>الأغاني</a>
                          </li>
                          <li class="nav-item" role="presentation">
                            <a class="nav-link" id="videos-tab" data-bs-toggle="tab" data-bs-target="#videos" type="button" role="tab" aria-controls="videos" aria-selected="false"><i class ="fa fa-video" style="margin-right: 10px;"></i>الفيديوهات</a>
                          </li>
                        </ul>  
                            <?php 
                            if(isset($_SESSION["loginin"]) && $_SESSION["loginin"]==true && $_SESSION["admin"]==1){
                                echo '<div class="sb-sidenav-menu-heading">الأدوات</div>';
                                echo '<a class="nav-link" href="insert_file.php"><i class="fas fa-chart-area"style="margin-right: 10px;" ></i>إضافة ملف جديد</a>';
                            }?>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                    <?php if($_SESSION["loginin"]==true){
                            echo '<div class="small">تم تسجيل الدخول بصفتك</div>';
                         echo $_SESSION["name"];
                        }
                        ?>
                </nav>
            </div>
    <div class="grid-container" id="layoutSidenav_content">
    <!--  button to insert new file -->
    <button class="insertbtn btn btn-success" onclick="window.location.href='insert_file.php'"> <a href="insert_file.php">إضافة ملف جديد</a> </button>
            <!-- Tab panes -->
            <div class="tab-content">
            <div class="tab-pane fade show active" id="books" role="tabpanel" aria-labelledby="books-tab">
                <div class="books">
                        <h1><i class ="fa fa-book" style="margin-right: 10px;"></i>Books</h1>
                        <!-- loop to get file info for every data type (pdf,mp3,mp4) -->
                        <?php foreach ($files as $file) : if ($file['type'] == "pdf") { ?>

                                <!--  new book item -->
                                <div class="gallery" id="file" +<?php echo $file['id'] ?>>

                                    <!--  hidden input to grap the file name -->
                                    <input id=<?php echo "f" . $file['id'] ?> name="<?php echo $file['name']; ?>" class="hidden">
                                    <!-- file id (hidden) -->
                                    <div class="hidden"><?php echo $file['id'] ?></div>
                                    
                                    <img id=<?php echo "p" . $file['id'] ?> src="uploadspics/<?php echo $file['file_pic']; ?>" alt="<?php echo $file['file_pic']; ?>" />
                                    <!--  book title -->
                                    <div class="title">
                                        <h5><?php echo $file['file_title']; ?></h5>
                                    </div>
                                    <!--  book discription -->
                                    <div class="desc"><?php echo $file['file_desc']; ?></div>
                                    <!--  Admin control buttons -->
                                    <div class="row btnwrapper">
                                        <div class="col-3">
                                            <button class="btndownload btn btn-success fas fa-download" onclick="window.location.href='admin_library.php?file_id=<?php echo $file['id'] ?>'">Download</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="btnedit btn btn-warning fas fa-edit" onclick="window.location.href= 'update_files.php?id=<?php echo $file['id']; ?>'">Edit</button>
                                        </div>
                                        <div class="col-3">
                                            <button class="btndelete btn btn-danger fas fa-trash" id="deletebtn" onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='block'">Delete</button>
                                        </div>
                                    </div>

                        <!-- delete hidden modal (are you sure you want to delete) -->

                        <div id="modal<?php echo $file['id'] ?>" class="modal">
                            <span onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <form class="modal-content" action="/action_page.php">
                                <div class="container">
                                    <h1>Delete File</h1>
                                    <p>Are you sure you want to delete this File?</p>

                                    <div class="clearfix row">
                                        <div class="col-5">
                                            <button type="button" class="cancelbtn" onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='none'">Cancel</button>
                                        </div>
                                        <div class="col-5">
                                            <button type="button" class="deletebtn" onclick="deleteMe()" name="<?php echo $file['id'] ?>">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php }
            endforeach; ?>
        </div>
    </div>
        <div class="tab-pane fade" id="songs" role="tabpanel" aria-labelledby="songs-tab">
        <div class="songs">
            <h1><i class ="fa fa-music" style="margin-right: 10px;"></i>Songs</h1>
            <?php
            foreach ($files as $file) : if ($file['type'] == "mp3") { ?>

                    <!--  new song item -->

                    <div class="gallery" id="file" +<?php echo $file['id'] ?>>

                        <!--  hidden input to grap the file name -->
                        <input id=<?php echo "f" . $file['id'] ?> name="<?php echo $file['name']; ?>" class="hidden">
                        <!-- id -->
                        <div class="hidden"><?php echo $file['id'] ?></div>
                        <!-- file image -->
                        <img id=<?php echo "p" . $file['id'] ?> src="uploadspics/<?php echo $file['file_pic']; ?>" alt="<?php echo $file['file_pic']; ?>" />
                        <!-- song source -->
                        <audio controls controlslist="nodownload">
                            <source src="uploads/<?php echo $file['name']; ?>" class="desc" type="audio/mpeg">
                            <?php echo $file['name']; ?>
                        </audio>
                        <!-- song title -->
                        <div class="title">
                            <h5><?php echo $file['file_title']; ?></h5>
                        </div>
                        <!-- song discription (hidden) -->
                        <div class="desc"><?php echo $file['file_desc']; ?></div>
                        <!-- Admin control buttons -->
                        <div class="row btnwrapper">
                            <div class="col-3">
                                <button class="btndownload btn btn-success fas fa-download" onclick="window.location.href='admin_library.php?file_id=<?php echo $file['id'] ?>'">Download</button>
                            </div>
                            <div class="col-3">
                                <button class="btnedit btn btn-warning fas fa-edit" onclick="window.location.href= 'update_files.php?id=<?php echo $file['id']; ?>'">Edit</button>
                            </div>
                            <div class="col-3">
                                <button class="btndelete btn btn-danger fas fa-trash" id="deletebtn" onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='block'">Delete</button>
                            </div>
                        </div>
                        <!-- delete hidden modal (are you sure you want to delete) -->

                        <div id="modal<?php echo $file['id'] ?>" class="modal">
                            <span onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <form class="modal-content" action="/action_page.php">
                                <div class="container">
                                    <h1>Delete File</h1>
                                    <p>Are you sure you want to delete this File?</p>

                                    <div class="clearfix row">
                                        <div class="col-5">
                                            <button type="button" class="cancelbtn" onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='none'">Cancel</button>
                                        </div>
                                        <div class="col-5">
                                            <button type="button" class="deletebtn" onclick="deleteMe()" name="<?php echo $file['id'] ?>">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php }
            endforeach; ?>
        </div>
        </div>
        <div class="tab-pane fade" id="videos" role="tabpanel" aria-labelledby="videos-tab">
        <div class="videos">
            <h1><i class ="fa fa-video" style="margin-right: 10px;"></i>videos</h1>
            <?php
            foreach ($files as $file) : if ($file['type'] == "mp4") { ?>

                    <!-- new video item -->
                    <div class="gallery" id="file" +<?php echo $file['id'] ?>>

                        <!--  hidden input to grap the file name -->
                        <input id=<?php echo "f" . $file['id'] ?> name="<?php echo $file['name']; ?>" class="hidden">
                        <!-- id -->
                        <div class="hidden"><?php echo $file['id'] ?></div>
                        <!-- img hidden (using background pic instead) -->
                        <img id=<?php echo "p" . $file['id'] ?> src="" alt="<?php echo $file['file_pic']; ?>" width="600" height="400" class="hidden" />
                        <!-- video source (using background pic) -->
                        <video controls controlslist="nodownload" poster="//:0" style="background: transparent url('uploadspics/<?php echo $file['file_pic']; ?>') 50% 50% / cover no-repeat ;">
                            <source src="uploads/<?php echo $file['name']; ?>" class="desc" type="audio/mpeg">
                            <?php echo $file['name']; ?>
                        </video>
                        <!-- video title -->
                        <div class="title">
                            <h5><?php echo $file['file_title']; ?></h5>
                        </div>

                        <div class="desc hidden"><?php echo $file['file_desc']; ?></div>

                        <!-- Admin control buttons -->
                        <div class="row btnwrapper">
                            <div class="col-3">
                                <button class="btndownload btn btn-success fas fa-download" onclick="window.location.href='admin_library.php?file_id=<?php echo $file['id'] ?>'">Download</button>
                            </div>
                            <div class="col-3">
                                <button onclick="window.location.href= 'update_files.php?id=<?php echo $file['id']; ?>'" class="btnedit btn btn-warning fas fa-edit">Edit</button>
                            </div>
                            <div class="col-3">
                                <button class="btndelete btn btn-danger fas fa-trash" id="deletebtn" onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='block'">Delete</button>
                            </div>
                        </div>
                        <!-- delete hidden modal (are you sure you want to delete) -->

                        <div id="modal<?php echo $file['id'] ?>" class="modal">
                            <span onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='none'" class="close" title="Close Modal">&times;</span>
                            <form class="modal-content" action="/action_page.php">
                                <div class="container">
                                    <h1>Delete File</h1>
                                    <p>Are you sure you want to delete this File?</p>

                                    <div class="clearfix row">
                                        <div class="col-5">
                                            <button type="button" class="cancelbtn" onclick="document.getElementById('modal<?php echo $file['id'] ?>').style.display='none'">Cancel</button>
                                        </div>
                                        <div class="col-5">
                                            <button type="button" class="deletebtn" onclick="deleteMe()" name="<?php echo $file['id'] ?>">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            <?php }
            endforeach;
            ?>
        </div>
    </div>
</div>
    <script>
         async function deleteMe() {
            //add event listner to get the clicked item id then sending the id to
            //deletefile.php by ajax to delete it without reloading the page.
             var myid = 0;
             var pic ='';
             var name='';
             window.thedelete = function(e) {
                e = e || window.event;
                target = e.target || e.srcElement;

                 myid = target.getAttribute('name');
                 name = $("#f" + myid).attr('name');
                 pic = $("#p" + myid).attr('alt');
                console.log(e);
            

                $.ajax({
                    type: "GET",
                    url: "deletefile.php",
                    data: {
                        id: myid,
                        filename: name,
                        picname: pic,
                    },
                    dataType: "html",
                    success: function(data) {
                        if(myid!=null){
                        $('#body').load('admin_library.php');
                        } 
                    }
                });
            }

             document.addEventListener('click',thedelete(window.event),false);

             document.removeEventListener('click', thedelete(window.event) , false);    
        };
    </script>
    <!-- bootstap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- script -->
    <script src="js/scripts.js"></script>

</body>

</html>