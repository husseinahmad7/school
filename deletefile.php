<?php
            //connecting to db
            include 'dbConfig.php';

            //getting the files we want to delete id to delete it from db 
            //and getting the file and pics names to delete them from the server

            //delete the file info from db
            if(isset($_GET['id'] ,$_GET['filename'], $_GET['picname'])){
            $sql = "DELETE FROM school_pdf WHERE id=" . $_GET['id'];
            $result= mysqli_query($conn,$sql);


            //delete file and pic from server
            if (unlink("uploads/".$_GET['filename'])&&unlink("uploadspics/".$_GET['picname'])) {
                echo 'The file ' . $_GET['filename'] . ' was deleted successfully!';
            } else {
                echo 'There was a error deleting the file ' . $_GET['filename'];
            }
        }
