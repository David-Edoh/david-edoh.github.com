<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap/bootstrap-grid.min.css">
    <link rel="stylesheet" href="dropzone/dropzone.css">
  <!-- <link rel="stylesheet" href="dropzone/basic.css"> -->

    <title>Upload a Scene</title>
</head>
<body>
<nav class="nav navbar-nav">
    <div class="nav-item">
        <!-- LOGO -->
    </div>
</nav>
    <div class="container">
        
        <div class="row">
            <div class="col">
                <!-- <div class="table table-striped" class="files" id="previews">

                    <div id="template" class="file-row">
                        <div>
                            <span class="preview"><img data-dz-thumbnail /></span>
                        </div>
                        <div>
                            <p class="name" data-dz-name></p>
                            <strong class="error text-danger" data-dz-errormessage></strong>
                        </div>
                        <div>
                            <p class="size" data-dz-size></p>
                            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                            </div>
                        </div>
                        <div>
                        <button class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start</span>
                        </button>
                        <button data-dz-remove class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                        <button data-dz-remove class="btn btn-danger delete">
                            <i class="glyphicon glyphicon-trash"></i>
                            <span>Delete</span>
                        </button>
                        </div>
                    </div>

   
                </div> -->

               
                <div class="card shadow-sm">
                    <div class="card-header">
                    <h4>Upload all scene files here</h4>
                    </div>
                </div>

                <!-- <form action="post_models.php" class="dropzone" id="my-awesome-dropzone">
                </form> -->

                <form action="post_models.php" method="post">
                    <div id="dropzone-box" class="dropzone"></div>
                    <div class="form-group">
                        <label for="name">Scene Name: </label>
                        <input type="text" name="" class="form-control" style="display: block;" id="name" placeholder="Scene Name">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Submit" class="btn btn-success" onclick="processQueue(event)">
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="dropzone/dropzone.js"></script>
    <script src="js/app.js"></script>
    <script>



    Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone(document.getElementById('dropzone-box'), { 
            url: "post_models.php", // Set the url
            dictDefaultMessage: "Drop all scene files here or<br>click to upload...",
            uploadMultiple: true,
            autoProcessQueue: false,
            acceptedFiles: ".mtl, .obj, .jpg, .jpeg, .png",
            addRemoveLinks: true,

            dictInvalidFileType: "Invalid File Type",
            dictCancelUpload: "Cancel",
            dictRemoveFile: "Remove",
            
            init: function() {
                this.on("sending", function(file, xhr, formData) {
                    let sceneName = $('#name').val();
                    console.log(sceneName);
                    formData.append("name", sceneName);
                    console.log(formData);
                });
            }

            // thumbnailWidth: 80,
            // thumbnailHeight: 80,
            // parallelUploads: 20,
            // previewTemplate: previewTemplate,
            // autoQueue: false, // Make sure the files aren't queued until manually added
            // previewsContainer: "#dropzone-box", // Define the container to display the previews
            // clickable: ".dropzone"
         });

         function processQueue(e)
         {
             e.preventDefault();
            myDropzone.processQueue()
         }
    </script>
</body>
</html>