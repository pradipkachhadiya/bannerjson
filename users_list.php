<?php
session_start();
    if(empty($_SESSION["is_login"])){
        header("location:/");
    }
?>
<html>  
    <head>  
        <title>User</title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="./css/custom.css"> 
    </head>  
    <body>  
        <input type="hidden" class="token" value="<?php echo md5($_SESSION["email"]) ?>">
        <?php include("header.php") ?>
                    <div class="row" id="main">

                        <div class="col-sm-12 col-md-12" id="content">
                            <br>
                            <div id="messages"></div>

                            <h2> User List </h2>
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#userModal">
                            Add User
                            </button>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Profile</th>
                                    <th>Permission</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="live_data">
                                
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    
                                    <form id="addUpdateUser" method="post" enctype="multipart">
                                        <div class="modal-body">       
                                            <div class="form-group">
                                                <label for="fullname">Fullname</label>
                                                <input type="text" class="form-control" id="fullname" placeholder="Enter Fullname" name="fullname" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
                                            </div>

                                            <div class="form-group">
                                                <label for="profile_image">Upload Profile</label>
                                                <input type="file" class="form-control" id="profile_image" name="profile_image">
                                                <div class="prview_img">
                                                </div>
                                            </div>

                                            <div class="form-group checkbox_list">
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="permission[]" class="permission" id="checkboxAdd" value="Add">Add
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="permission[]" class="permission" id="checkboxUpdate" value="Update">Update
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="permission[]" class="permission" id="checkboxDelete" value="Delete">Delete
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" name="permission[]" class="permission" id="checkboxView" value="View">View
                                                </label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="hidden" class="form-control" id="id" name="id">
                                            <input type="hidden" class="form-control" id="flag" name="flag" value="1">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
            var token = $(".token").val();
            function fetch_data()  
            {  
                
                $.ajax({  
                    url:"selectUser.php",  
                    method:"GET",  
                    headers: {
                        'token': token,
                        'flag' : 1
                    }, 
                    success:function(data){  
                        console.log(data);
                        var html = "";
                        $.each(data, function(index, value) {
                            if(value.profile_image){
                                var profile_image = value.profile_image;
                            }else{
                                var profile_image = 'uploads/default.png';
                            }
                            if(value.status == 1){
                                var checked = 'checked'
                            }else{
                                var checked = '';
                            }

                            var status = '<label class="switch"> <input type="checkbox" class="changeStatus" '+checked+' data-id="'+value.id+'" data-status="'+value.status+'"> <span class="slider round"></span> </label>';

                            html += '<tr> <td>'+value.fullname+'</td> <td>'+value.email+'</td> <td><img src="'+profile_image+'" width="80" height="80"></td>   <td>'+value.permission+'</td> <td>'+status+'</td> <td><button type="button" class="btn btn-success EditUser" data-id="'+value.id+'" data-fullname="'+value.fullname+'" data-email="'+value.email+'"  data-profile_image="'+profile_image+'" data-permission="'+value.permission+'" data-status="'+value.status+'" data-toggle="modal" data-target="#userModal"> Edit </button>  <button type="button" class="btn btn-danger deleteUser" data-id="'+value.id+'"> Delete </button></td> </tr>'
                        });
                        $('#live_data').html(html);  
                    }  
                });  
            }  
            fetch_data(); 

            $(".checkbox_list").each(function (i, li) {
                var currentli = $(li);
                $(currentli).find("#checkboxAdd").on('change', function () {
                    $(currentli).find("#checkboxView").prop('checked',true);
                });

                $(currentli).find("#checkboxUpdate").on('change', function () {
                    $(currentli).find("#checkboxView").prop('checked', true);
                });
                $(currentli).find("#checkboxDelete").on('change', function () {
                    $(currentli).find("#checkboxView").prop('checked', true);
                });
            }); 

            $('#userModal').on('hidden.bs.modal', function(e) {
                $("#addUpdateUser")[0].reset();
                $('.modal-title').text('Add User');
                $('#id').val("");
                $('.prview_img').html("");
                validator.resetForm();
            });
        

            $(document).on("click", ".EditUser", function() {

                $('.modal-title').text('Edit User');

                $('#id').val($(this).attr('data-id'));
                $('#fullname').val($(this).attr('data-fullname'));
                $('#email').val($(this).attr('data-email'));
                $('#password').val($(this).attr('data-password'));
                var permission = $(this).attr('data-permission');
                permission = permission.split(',');

                $(permission).each(function (i, value) {
                    $('.permission[value="'+value+'"]').prop('checked',true);
                });

                var profile_image = $(this).attr('data-profile_image');
                var html = '<div class="borderwrap"><div class="filenameupload"><img src="'+profile_image+'" width="400" height="200"> </div>  </div>';
                $('.prview_img').html(html);

            });

            $(document).on('submit', '#addUpdateUser', function (e) {
                e.preventDefault();
                
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
                        $('#userModal').modal('hide');
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

            $(document).on('click', '.deleteUser', function(){  
                var id=$(this).attr("data-id");  
                if(confirm("Are you sure you want to delete this?"))  
                {  
                    $.ajax({  
                        url:"deleteUser.php",  
                        method:"POST",  
                        data:{id:id},  
                        dataType:"json",  
                        success:function(data){  
                            fetch_data();  
                            $('#messages').addClass('alert alert-success').html(data.message);
                        }  
                    });  
                }  
            });  

            $(document).on('change', '.changeStatus', function(){  
                var id=$(this).attr("data-id");  
                var status=$(this).attr("data-status"); 
                if(status == 1){
                    status = 0;
                }else{
                    status = 1;
                }
                if(confirm("Are you sure you want to Change this?"))  
                {  
                    $.ajax({  
                        url:"changeUserStatus.php",  
                        method:"POST",  
                        data:{id:id,status:status},  
                        dataType:"json",  
                        success:function(data){  
                            fetch_data();  
                            $('#messages').addClass('alert alert-success').text(data.message);
                        }  
                    });  
                }  
            });  
        });  
        </script>
 <?php include("footer.php") ?>
    </body>  
</html>  