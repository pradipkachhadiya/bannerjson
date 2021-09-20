<?php
$connect = mysqli_connect("localhost", "root", "","content_stc"); 
session_start();
    if(empty($_SESSION["is_login"])){
        header("location:/content-stc/");
    }
    $id = $_SESSION["id"];
    $sql = "SELECT * FROM tbl_users WHERE id= '$id' AND is_deleted=0";  
    $result = mysqli_query($connect, $sql) or die (mysqli_error($connect));;
    $data = [];
    if ($result->num_rows > 0) {
         while($row=mysqli_fetch_assoc($result))
         {
              $data['fullname'] = $row["fullname"];
              $data['email'] = $row["email"];
              $data['profile_image'] = $row["profile_image"];
         }
    }
?>
<html>  
    <head>  
        <title>Content</title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css"> 
        <style>
            body {
                padding-top: 50px;
            }
            footer {
                padding-left: 15px;
                padding-right: 15px;
            }

            /*
            * Off Canvas
            * --------------------------------------------------
            */
            @media screen and (max-width: 768px) {
            .row-offcanvas {
                position: relative;
                -webkit-transition: all 0.25s ease-out;
                -moz-transition: all 0.25s ease-out;
                transition: all 0.25s ease-out;
                background:#ecf0f1;
            }

            .row-offcanvas-left
            .sidebar-offcanvas {
                left: -40%;
            }

            .row-offcanvas-left.active {
                left: 40%;
            }

            .sidebar-offcanvas {
                position: absolute;
                top: 0;
                width: 40%;
                margin-left: 12px;
            }
            }

            #sidebar {
                padding:15px;
                margin-top:10px;
            }
            .nav>.active>a, .nav>.active>a:focus, .nav>.active>a:hover {
                color: #555;
                background-color: #e7e7e7;
            }
        </style>
    </head>  
    <body>  
    <input type="hidden" class="token" value="<?php echo md5($_SESSION["email"]) ?>">
        <input type="hidden" class="permission" value="<?php echo $_SESSION["permission"] ?>">
        <div class="navbar navbar-fixed-top navbar-default" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Content Stc</a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="profile.php" id="profile">Profile</a>
                    </li>
                    <li>
                        <a href="logout.php" id="logout">Logout</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row row-offcanvas row-offcanvas-left">
                <div class="col-xs-6 col-sm-2 sidebar-offcanvas" id="sidebar" role="navigation">
                    <div class="sidebar-nav">
                        <ul class="nav">
                        <?php if($_SESSION["role"] == 1){ ?>
                            <li><a href="/content-stc/users_list.php">User</a></li>
                        <?php } ?>
                            <li class="active"><a href="/content-stc/content_list.php">Content</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-10">
                    <br>
                    <div id="messages"></div>

                    <h2> Update Profile</h2>
                    <div class="col-xs-12 col-sm-6">
                        <form id="addUpdateUser" method="post" enctype="multipart">
                            <div class="form-group">
                                <label for="fullname">Fullname</label>
                                <input type="text" class="form-control" id="fullname" placeholder="Enter Fullname" name="fullname" value="<?php echo $data["fullname"]?>" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" value="<?php echo $data["email"]?>">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                            </div>

                            <div class="form-group">
                                <label for="profile_image">Upload Profile</label>
                                <input type="file" class="form-control" id="profile_image" name="profile_image">
                                <div class="prview_img">
                                <?php if($data["profile_image"]){ ?>
                                    <div class="borderwrap" data-href="<?php echo $data["profile_image"] ?>"><div class="filenameupload"><img src="<?php echo 'uploads/'.$data["profile_image"] ?>" width="400" height="200"> </div></div>
                                <?php } ?>
                                </div>
                            </div>

                            <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_SESSION["id"]?>">
                            <input type="hidden" class="form-control" id="flag" name="flag" value="1">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form> 
                    </div>
                </div>
               
            </div>

            <hr>
            <!-- <footer>
                <p>© Company 2013</p>
            </footer> -->
        </div>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>  
        $(document).ready(function(){  

            $(document).on('change', '#profile_image', function() {
                imagesPreview(this, '.prview_img');
            });

            var imagesPreview = function(input, placeToInsertImagePreview) {

                if (input.files) {
                    var filesAmount = input.files.length;
                    var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.jfif|\.webp)$/i;

                    if(!allowedExtensions.exec(input.value)){
                        iziToast.error({
                        title: 'Error!',
                        message: 'Please upload file having extensions .jpeg/.jpg/.png only.',
                        position: 'topRight'
                        });
                        input.value = '';
                        return false;
                    }else{

                        var reader = new FileReader();

                        reader.onload = function(event) {
                        $(placeToInsertImagePreview).html('<div class="borderwrap" data-href="'+event.target.result+'"><div class="filenameupload"><img src="'+event.target.result+'" width="400" height="200"> </div></div>');
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            };

            $(document).on('submit', '#addUpdateUser', function (e) {
                e.preventDefault();
                var token = $(".token").val();
                var formdata = new FormData($("#addUpdateUser")[0]);
                $('.loader').show();
                $.ajax({
                    url: 'addUpdateUser.php',
                    type: 'POST',
                    data: formdata,
                    dataType: "json",
                    headers: {
                        'token': token,
                    }, 
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function (data) {
                        $('.loader').hide();
                        if (data.success == 1) {
                            $('#messages').addClass('alert alert-success').text(data.message);
                        } else {
                            $('#messages').addClass('alert alert-danger').text(data.message);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        alert(errorThrown);
                    }
                });
            });

        });  
        </script>

    </body>  
</html>  