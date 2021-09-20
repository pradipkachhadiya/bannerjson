<?php
session_start();
    if(empty($_SESSION["is_login"])){
        header("location:/content-stc/");
    }
    if(!empty($_SESSION["permission"])){
        $permission = explode(',',$_SESSION["permission"]);
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
                <?php if (in_array('View', $permission)){ ?>
                <div class="col-xs-12 col-sm-10">
                    <br>
                    <div id="messages"></div>

                    <h2> Content List </h2>
                    <?php if (in_array('Add', $permission)){ ?>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contentModal">
                    Add Content
                    </button>
                    <?php } ?>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th>Banner</th>
                            <th>Qr Code</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="live_data">
                        
                        </tbody>
                    </table>
                </div>
            <?php } else { ?>
                <div class="col-xs-12 col-sm-10">
                    <h2> You don't have permission to Manage Content</h2>
                </div>
            <?php } ?>
            </div>

            <div class="modal fade" id="contentModal" tabindex="-1" role="dialog" aria-labelledby="contentModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contentModalLabel">Add Content</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            
                            <form id="addUpdateContent" method="post" enctype="multipart">
                                <div class="modal-body">       
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" placeholder="Enter Description" name="description" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="link">Link</label>
                                        <input type="text" class="form-control" id="link" placeholder="Enter Link" name="link">
                                    </div>

                                    <div class="form-group">
                                        <label for="banner">Upload Banner</label>
                                        <input type="file" class="form-control" id="banner" name="banner">
                                        <div class="prview_img">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="qr_code">Qr Code</label>
                                        <input type="text" class="form-control" id="qr_code" placeholder="Enter Qr Code" name="qr_code">
                                    </div>
                                    <div class="form-group">
                                        <label class="radio-inline">
                                            <input type="radio" name="status" class="status" value="1" checked>Publish
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status" class="status" value="2">Draft
                                        </label>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" class="form-control" id="id" name="id">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
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

            $(document).ready(function() {
                $('[data-toggle=offcanvas]').click(function() {
                    $('.row-offcanvas').toggleClass('active');
                });
            });

            $(document).on('change', '#banner', function() {
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
            var token = $(".token").val();

            function fetch_data()  
            {  
                var permission = $(".permission").val();
                var arr = permission.split(",");
                $.ajax({  
                    url:"select.php",  
                    method:"GET", 
                    headers: {
                        'token': token,
                        'flag': 1
                    }, 
                    success:function(data){  
                        var html = "";
                        $.each(data, function(index, value) {
                            if(value.banner){
                                var banner = 'uploads/'+value.banner;
                            }else{
                                var banner = 'uploads/default.png';
                            }
                            if(value.status == 1){
                                var status = '<span class="label label-success">Publish</span>'
                            }else{
                                var status = '<span class="label label-danger">Draft</span>';
                            }
                            var updatehtml = "";
                            if (arr.indexOf('Update') !== -1) {
                                var updatehtml = '<button type="button" class="btn btn-success EditContent" data-id="'+value.id+'" data-title="'+value.title+'" data-description="'+value.description+'" data-link="'+value.link+'" data-banner="'+banner+'" data-qr_code="'+value.qr_code+'" data-status="'+value.status+'" data-toggle="modal" data-target="#contentModal"> Edit </button>';
                            } 
                            var deletehtml = "";
                            if (arr.indexOf('Delete') !== -1) {
                                var deletehtml = '<button type="button" class="btn btn-danger deleteContent" data-id="'+value.id+'"> Delete </button>';
                            }
                            html += '<tr> <td>'+value.title+'</td> <td>'+value.description+'</td> <td>'+value.link+'</td> <td><img src="'+banner+'" width="150" height="150"></td>  <td>'+value.qr_code+'</td>  <td>'+status+'</td> <td> '+updatehtml+' '+deletehtml+'  </td> </tr>'
                        });
                        $('#live_data').html(html);  
                    }  
                });  
            }  
            fetch_data();  

            $('#contentModal').on('hidden.bs.modal', function(e) {
                $("#addUpdateContent")[0].reset();
                $('.modal-title').text('Add User');
                $('#id').val("");
                $('.prview_img').html("");
                validator.resetForm();
            });

            $(document).on("click", ".EditContent", function() {

                $('.modal-title').text('Edit Content');

                $('#id').val($(this).attr('data-id'));
                $('#title').val($(this).attr('data-title'));
                $('#description').val($(this).attr('data-description'));
                $('#link').val($(this).attr('data-link'));
                $('#qr_code').val($(this).attr('data-qr_code'));
                var status = $(this).attr('data-status');
                $('input:radio[class=status][value='+status+']').prop('checked', true);

                var banner = $(this).attr('data-banner');
                var html = '<div class="borderwrap"><div class="filenameupload"><img src="'+banner+'" width="400" height="200"> </div>  </div>';
                $('.prview_img').html(html);

            });

            $(document).on('submit', '#addUpdateContent', function (e) {
                e.preventDefault();
                
                var formdata = new FormData($("#addUpdateContent")[0]);
                $('.loader').show();
                $.ajax({
                    url: 'addUpdate.php',
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
                        $('#contentModal').modal('hide');
                        fetch_data();  
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

            $(document).on('click', '.deleteContent', function(){  
                var id=$(this).attr("data-id");  
                if(confirm("Are you sure you want to delete this?"))  
                {  
                    $.ajax({  
                        url:"delete.php",  
                        method:"POST",  
                        data:{id:id},  
                        dataType:"json",
                        headers: {
                            'token': token,
                        },   
                        success:function(data){  
                            fetch_data();  
                            $('#messages').addClass('alert alert-success').text(data.message);
                        }  
                    });  
                }  
            });  
        });  
        </script>

    </body>  
</html>  