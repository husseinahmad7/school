<?php
// connect to the database
include_once 'dbConfig.php';

$sSQL = 'SET CHARACTER SET UTF8';
$result = mysqli_query($conn, $sSQL);
$sql = "SELECT * FROM school_pdf";

$result = mysqli_query($conn, $sql);
$files = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Uploads files
// if save button on the form is clicked
if (isset($_POST['save'])) {
    // data of the uploaded file
    $filename = $_FILES['myfile']['name'];
    $fileTitle = $_POST['filetitle'];
    $fileDesc = $_POST['filedesc'];
    $filePic = $_FILES['filepic']['name'];

    // destination of the file and file pic on the server
    $destination = 'uploads/' . $filename;
    $picsDestination = 'uploadspics/' . $filePic;

    // get the file and file pic extension
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $picsExtension = pathinfo($filePic, PATHINFO_EXTENSION);

    // the physical files on a temporary uploads directory on the server
    $file = $_FILES['myfile']['tmp_name'];
    $filepic = $_FILES['filepic']['tmp_name'];
    //getting file size
    $size = $_FILES['myfile']['size'];

    //file should be pdf, mp3, or mp4
    if (!in_array($extension, ['pdf', 'mp3', 'mp4'])) {
        echo "Your file extension must be pdf, mp3 or mp4 ";
    } elseif ($_FILES['myfile']['size'] > 10000000) { // file shouldn't be larger than 10 Megabyte
        echo "File too large!";
        echo "your file size must be less than 2 MB";
    } elseif (!in_array($picsExtension, ['JPG', 'png', 'JPEG', 'jpg', 'jpeg'])) {
        echo "Your file extension must be .JPG, png or JPEG";
    } else {
        try {
            // move the uploaded (temporary) file to the specified destination
            move_uploaded_file($file, $destination);
            move_uploaded_file($filepic, $picsDestination);

                //insert file info to db
                $sql = "INSERT INTO school_pdf (name, size, downloads, file_pic, file_desc, file_title, type) VALUES ('$filename', $size, 0, '$filePic', '$fileDesc', '$fileTitle', '$extension')";
                if (mysqli_query($conn, $sql)) {
                    echo "تم إضافة الملف بنجاح";
                }
                else {
                    echo ".فشلت إضافة الملف";
                }
        } catch (Exception $e) {
            echo "فشلت إضافة الملف";
            echo 'Message: ' . $e->getMessage();
        }
    }
}
// Downloads files

if (isset($_GET['file_id'])) {
    if ($_SESSION["loginin"] == true) {
        $id = $_GET['file_id'];

        // fetch file to download from database
        $sql = "SELECT * FROM school_pdf WHERE id=$id";
        $result = mysqli_query($conn, $sql);

        $file = mysqli_fetch_assoc($result);
        $filepath = 'uploads/' . $file['name'];

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . basename($filepath));
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize('uploads/' . $file['name']));
            readfile('uploads/' . $file['name']);

            // Now update downloads count
            $newCount = $file['downloads'] + 1;
            $updateQuery = "UPDATE school_pdf SET downloads=$newCount WHERE id=$id";
            mysqli_query($conn, $updateQuery);
            exit;
        }
    } else {
        echo '<script>window.alert("يجب تسجيل الدخول أولاً..!")</script>';
        echo '<script>
        window.location.href="index.php#sec2";
        </script>';
    }
}
