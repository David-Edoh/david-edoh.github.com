<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="utf-8">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>Virtual Art Scene</title>
  <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.min.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="TemplateData/favicon.ico">
  <link rel="stylesheet" href="TemplateData/style.css">
</head>
<body>

<?php
    $servername = "localhost";
    $dbname = "virtualart";
    $username = "root";
    $password = "";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    // $conn->close();
  ?>


<!-- Team -->
<section id="team" class="pb-5">
  <div class="container">
      <h5 class="section-title h1">Galleries</h5>
      <div class="row">
      <?php
       
      $sql="SELECT * FROM `scenes` WHERE 1;";

      $result = mysqli_query( $conn, $sql);
      
        while($row = mysqli_fetch_array($result)) {
          echo (
            '<div class="col-xs-12 col-sm-6 col-md-4">
                <div class="image-flip" >
                    <div class="mainflip flip-0">
                        <div class="frontside">
                            <div class="card">
                                <div class="text-center">
                                    <p>
                                      <img class=" img-fluid" src="'.$row['thumb_path'].'" alt="'.$row['name'].'">
                                    </p>
                                    <h4 class="card-title">' .$row['name']. '</h4>
                                </div>
                            </div>
                        </div>
                        <div class="backside">
                            <div class="card">
                                <div class="text-center mt-4">
                                    <h4 class="card-title">' .$row['name']. '</h4>
                                    <p class="card-text">' .$row['description']. '</p>
                                    <button class="btn btn-info" data-toggle="modal" data-target="#exampleModalCenter" onclick="loadScene()"> Tour <i class="fa fa-eye"></i> </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>'
          );
        }
        ?>

      </div>
<a href="newscene.php" class="btn btn-info"> Add Scene </a>
  </div>
</section>

<!-- Team -->
  

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div id="unity-container" class="unity-desktop">
        <canvas id="unity-canvas"></canvas>
        <div id="unity-loading-bar">
            <div id="unity-logo"></div>
            <div id="unity-progress-bar-empty">
            <div id="unity-progress-bar-full"></div>
            </div>
        </div>
        <div id="unity-footer">
            <div id="unity-webgl-logo"></div>
            <div id="unity-fullscreen-button"></div>
            <div id="unity-build-title">Virtual Art Scene</div>
        </div>
        </div>
      </div>
    </div>
  </div>


<script src="js/jquery-3.5.1.min.js"></script>
<script src="js/bootstrap/bootstrap.bundle.min.js"></script>
<script src="js/bootstrap/bootstrap.min.js"></script>
<script src="js/app.js"></script>

<script>
  var buildUrl = "Build";
  var loaderUrl = buildUrl + "/Build.loader.js";
  var config = {
    dataUrl: buildUrl + "/Build.data.gz",
    frameworkUrl: buildUrl + "/Build.framework.js.gz",
    codeUrl: buildUrl + "/Build.wasm.gz",
    streamingAssetsUrl: "StreamingAssets",
    companyName: "DefaultCompany",
    productName: "RCODev Virtual Art Place",
    productVersion: "0.1",
  };

  var container = document.querySelector("#unity-container");
  var canvas = document.querySelector("#unity-canvas");
  var loadingBar = document.querySelector("#unity-loading-bar");
  var progressBarFull = document.querySelector("#unity-progress-bar-full");
  var fullscreenButton = document.querySelector("#unity-fullscreen-button");

  if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
    container.className = "unity-mobile";
    config.devicePixelRatio = 1;
  } else {
    canvas.style.width = "960px";
    canvas.style.height = "600px";
  }
  loadingBar.style.display = "block";


function loadScene()
{
  var script = document.createElement("script");
  script.src = loaderUrl;
  script.onload = () => {
    createUnityInstance(canvas, config, (progress) => {
      progressBarFull.style.width = 100 * progress + "%";
    }).then((unityInstance) => {
      loadingBar.style.display = "none";
      fullscreenButton.onclick = () => {
        unityInstance.SetFullscreen(1);
      };
    }).catch((message) => {
      alert(message);
    });
  };
  document.body.appendChild(script);
}
  
</script>
</body>
</html>