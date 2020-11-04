<?php
   $servername = "localhost";
   $dbname = "virtualart";
   $username = "root";
   $password = "";

   $conn = new mysqli($servername, $username, $password, $dbname);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }
   // $conn->close();

$ds          = DIRECTORY_SEPARATOR;  //1

mkdir("/StreamingAssets\/".$_POST['scene_name'], 0700);
 
$storeFolder = 'StreamingAssets';   //2
 
if (!empty($_FILES)) {
   
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4


    foreach($_FILES['file']['tmp_name'] as $key => $value) {

        $ext = end(explode('.', $_FILES['file']['name'][$key]));
        if($ext == "obj")
        {
            $sql = 'INSERT INTO `scenes`(`id`, `name`, `description`, `scene_path`, `thumb_path`, `client_id`, `created_at`, `updated_at`) VALUES ("","'.$_FILES['file']['name'][$key].'","description","'.$targetPath. $_FILES['file']['name'][$key].'","thumb_path","1","0000-00-00 00:00:00.000000","0000-00-00 00:00:00.000000");';
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
             } else {
                echo "Error: " . $sql . "" . mysqli_error($conn);
             }
            //save scene id to variable here.

        }

        if($ext != "obj" && $ext != "mtl")
        {
            $sql = 'INSERT INTO `images`(`id`, `name`, `path`, `scene_id`) VALUES ("","'.$_FILES['file']['name'][$key].'","'.$targetPath. $_FILES['file']['name'][$key].'", "1");'; 
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
             } else {
                echo "Error: " . $sql . "" . mysqli_error($conn);
             }      
        }
    
    
        
        $tempFile = $_FILES['file']['tmp_name'][$key];
        $targetFile =  $targetPath. $_FILES['file']['name'][$key];
        move_uploaded_file($tempFile, $targetFile);
    }
     
}

if (!empty($_POST["name"])) {
    echo $_POST["name"];    
} else {  
    echo "No, name is not set";
}
?>     