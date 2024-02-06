<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" dir="rtl">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="css/indexsty.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Tajawal&display=swap" rel="stylesheet">
  <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
  <title>Our School Library</title>
</head>

<body>
  <?php
  include 'nav.php';
  ?>
  <div class="parallax position-relative">
    <div class="position-absolute heading-margin bottom-0 start-50 translate-middle-x">
      <h3 class="h1 glow p-3" style="font-size: 50px !important;">
        <span>مدرسة الأطفال العباقرة</span><br/>
        <span class="h1">ابدأ بالتعلم الآن !</span>
      </h3>
    </div>
    <div class="position-absolute heading-margin bottom-0 start-50 translate-middle-x">
      <div class="container-scroll">
        <div><button class=" chevron btn btn-primary fa fa-arrow-circle-down btnscroll" onclick="document.location='#sec2'"></button></div>
        <div id="sec2"></div>

      </div>
    </div>
  </div>
  <div class="container" id="start">
    <div class="card text-center" style="border-radius: 2em;
    margin: 2em 0;">
      <div class="center">
        <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
        <lottie-player class="card-img-top" src="https://assets3.lottiefiles.com/packages/lf20_nv1d6kvd.json" background="transparent" speed="1" style="width: 300px; height: 300px;border-radius:50%" loop autoplay></lottie-player>
      </div>

      <div class="card-body">
        <h5 class="card-title">
          أفضل الموارد
        </h5>
        <p class="card-text gradient-text-rad">
          <span>
            تعلم عن بعد
          </span>
          <br>
          <span>
            قيّم طفلك
          </span>
          <br>
          <span>
            شارك طفلك
          </span>
        </p>
        <a href="login.php" class="btn btn-secondary">
          سجل الدخول
        </a>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="card mb-3" style="border-bottom-right-radius: 2em;
    border-top-left-radius: 2em; background:transparent;">
      <div class="row g-0">
        <div class="col-md-6">
          <!-- magnifiered image -->
          <div class="img-magnifier-container">
            <img class="img-fluid rounded-start" id="myimage" src="static/flower.png" width="600" height="400" alt="search your skills">
          </div>
        </div>
        <div class="col-md-6 center">
          <div class="card-body gradient-text mx-auto">
            <h5 class="card-title center">
              استكشف..شارك..تعلم
            </h5>
            <br>
            <p class="card-text center">
              اقرأ الكتب المفيدة والممتعة
            </p>
            <br>
            <p class="card-text center">
              استمع للقصص الصوتية
            </p>
            <br>
            <p class="card-text center">
              شاهد فيديوهاتنا الرائعة
            </p>
            <p class="card-text center"><small class="text-muted">
                ابدأ معنا
              </small></p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container mx-auto center">
    <button class="btn-grad" onclick="document.location='register.php'">
      سـجل الآن
    </button>
  </div>

  <div class="container library" id="start">
    <div class="card text-center" style="border-radius: 2em;
    margin: 2em 0;">
      <h1 style="margin-top: 30px;">مكتبة متنوعة</h1>
      <h2>مجموعة متنوعة من الكتب والقصص والأغاني والأفلام</h2>
      <p class="card-text gradient-text-rad">
        <span style="font-size: 30px;">
          اقرأ..استمع..شاهد..وتعلم !
        </span>
      </p>
      <div class="center">
        <div class="row" style="padding: 50px;">
          <?php
          include 'filesLogic.php';
          $q = "SELECT * FROM school_pdf where type = 'pdf' LIMIT 1";
          $r = mysqli_query($conn, $q);
          $j = mysqli_fetch_all($r, MYSQLI_ASSOC);
          foreach ($j as $file) : if ($file['type'] == "pdf") { ?>

              <!--  new book item -->
              <div class="gallery col-4" id="file" +<?php echo $file['id'] ?>>
                <img id=<?php echo "p" . $file['id'] ?> src="uploadspics/<?php echo $file['file_pic']; ?>" alt="<?php echo $file['file_pic']; ?>" />
                <!--  book title -->
                <div class="title">
                  <h5><?php echo $file['file_title']; ?></h5>
                </div>
                <!--  book discription -->
                <div class="desc"><?php echo $file['file_desc']; ?></div>
                <!--  Admin control buttons -->
                <div class="row btnwrapper">
                  <div class="col-6">
                    <button class="btndownload btn btn-success" onclick="window.location.href='main_library.php?file_id=<?php echo $file['id'] ?>'">تحميل<i class="fas fa-download" style="margin-right: 10px;"></i></button>
                  </div>
                  <div class="col-6">
                    <?php
                    $readbook = 'uploads/' . $file['name'];
                    ?>
                    <button class="btndownload btn btn-primary" onclick="window.open('<?php echo $readbook; ?>')">قراءة<i class="fas fa-book" style="margin-right: 10px;"></i></button>
                  </div>
                </div>
              </div>
            <?php }
          endforeach;

          $q = "SELECT * FROM school_pdf where type = 'mp3' LIMIT 1";
          $r = mysqli_query($conn, $q);
          $s = mysqli_fetch_all($r, MYSQLI_ASSOC);

          foreach ($s as $file) : if ($file['type'] == "mp3") { ?>

              <!--  new song item -->

              <div class="gallery col-4" id="file" +<?php echo $file['id'] ?>>
                <!-- file image -->
                <img id=<?php echo "p" . $file['id'] ?> src="uploadspics/<?php echo $file['file_pic']; ?>" alt="<?php echo $file['file_pic']; ?>" />
                <!-- song title -->
                <div class="title">
                  <h5><?php echo $file['file_title']; ?></h5>
                </div>
                <!-- song discription (hidden) -->
                <div class="desc"><?php echo $file['file_desc']; ?></div>
                <!-- Admin control buttons -->
                <div class="row btnwrapper">
                  <div class="col-6">
                    <button class="btndownload btn btn-success" onclick="window.location.href='main_library.php?file_id=<?php echo $file['id'] ?>'">تحميل<i class="fas fa-download" style="margin-right: 10px;"></i></button>
                  </div>
                  <div class="col-6">
                    <?php
                    $readbook = 'uploads/' . $file['name'];
                    ?>
                    <button class="btndownload btn btn-primary" onclick="window.open('<?php echo $readbook; ?>')">استماع<i class="fas fa-music" style="margin-right: 10px;"></i></button>
                  </div>
                </div>
              </div>
            <?php }
          endforeach;

          $q = "SELECT * FROM school_pdf where type = 'mp4' LIMIT 1";
          $r = mysqli_query($conn, $q);
          $v = mysqli_fetch_all($r, MYSQLI_ASSOC);

          foreach ($v as $file) : if ($file['type'] == "mp4") { ?>
              <!-- new video item -->
              <div class="gallery col-4" id="file" +<?php echo $file['id'] ?>>


                <img id=<?php echo "p" . $file['id'] ?> src="uploadspics/<?php echo $file['file_pic']; ?>" alt="<?php echo $file['file_pic']; ?>" />

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
                  <div class="col-6">
                    <button class="btndownload btn btn-success" onclick="window.location.href='main_library.php?file_id=<?php echo $file['id'] ?>'">تحميل<i class="fas fa-download" style="margin-right: 10px;"></i></button>
                  </div>
                  <div class="col-6">
                    <?php
                    $readbook = 'uploads/' . $file['name'];
                    ?>
                    <button class="btndownload btn btn-primary" onclick="window.open('<?php echo $readbook; ?>')">مشاهدة<i class="fas fa-video" style="margin-right: 10px;"></i></button>
                  </div>
                </div>
              </div>
          <?php }
          endforeach;
          ?>


        </div>
      </div>
      <div class="card-body">
        <div class="container mx-auto center">
          <button class="btn-grad" style="margin-top: -40px;" onclick="document.location='main_library.php'">
            زيارة المكتبة
          </button>
        </div>
      </div>
    </div>
  </div>


  <div class="parallax"></div>
  <?php include 'footer.php' ?>
</body>
<script>
  function magnify(imgID, zoom) {
    var img, glass, w, h, bw;
    img = document.getElementById(imgID);

    /* Create magnifier glass: */
    glass = document.createElement("DIV");
    glass.setAttribute("class", "img-magnifier-glass");

    /* Insert magnifier glass: */
    img.parentElement.insertBefore(glass, img);

    /* Set background properties for the magnifier glass: */
    glass.style.backgroundImage = "url('" + img.src + "')";
    glass.style.backgroundRepeat = "no-repeat";
    glass.style.backgroundSize = (img.width * zoom) + "px " + (img.height * zoom) + "px";
    bw = 3;
    w = glass.offsetWidth / 2;
    h = glass.offsetHeight / 2;

    /* Execute a function when someone moves the magnifier glass over the image: */
    glass.addEventListener("mousemove", moveMagnifier);
    img.addEventListener("mousemove", moveMagnifier);

    /*and also for touch screens:*/
    glass.addEventListener("touchmove", moveMagnifier);
    img.addEventListener("touchmove", moveMagnifier);

    function moveMagnifier(e) {
      var pos, x, y;
      /* Prevent any other actions that may occur when moving over the image */
      e.preventDefault();
      /* Get the cursor's x and y positions: */
      pos = getCursorPos(e);
      x = pos.x;
      y = pos.y;
      /* Prevent the magnifier glass from being positioned outside the image: */
      if (x > img.width - (w / zoom)) {
        x = img.width - (w / zoom);
      }
      if (x < w / zoom) {
        x = w / zoom;
      }
      if (y > img.height - (h / zoom)) {
        y = img.height - (h / zoom);
      }
      if (y < h / zoom) {
        y = h / zoom;
      }
      /* Set the position of the magnifier glass: */
      glass.style.left = (x - w) + "px";
      glass.style.top = (y - h) + "px";
      /* Display what the magnifier glass "sees": */
      glass.style.backgroundPosition = "-" + ((x * zoom) - w + bw) + "px -" + ((y * zoom) - h + bw) + "px";
    }

    function getCursorPos(e) {
      var a, x = 0,
        y = 0;
      e = e || window.event;
      /* Get the x and y positions of the image: */
      a = img.getBoundingClientRect();
      /* Calculate the cursor's x and y coordinates, relative to the image: */
      x = e.pageX - a.left;
      y = e.pageY - a.top;
      /* Consider any page scrolling: */
      x = x - window.pageXOffset;
      y = y - window.pageYOffset;
      return {
        x: x,
        y: y
      };
    }
  }
  magnify("myimage", 3);
</script>

</html>