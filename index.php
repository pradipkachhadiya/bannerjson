<html>  
    <head>  
        <title>Content</title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> 
    </head>  
    <body>  
    <div class="container">
    <div class="row">
    <div id="messages"></div>

    <h2> Content List </h2>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#contentModal">
    Add
    </button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Link</th>
                <th>Banner</th>
                <th>Qr Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody id="live_data">
            
            </tbody>
        </table>
    </div>

    <!-- Modal -->
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

 
</div>
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>  
$(document).ready(function(){  

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

    function fetch_data()  
    {  
        
        $.ajax({  
            url:"select.php",  
            method:"GET",  
            success:function(data){  
                console.log(data);
                var html = "";
                $.each(data, function(index, value) {
                    if(value.banner){
                        var banner = 'uploads/'+value.banner;
                    }else{
                        var banner = 'uploads/default.png';
                    }
                    html += '<tr> <td>'+value.title+'</td> <td>'+value.description+'</td> <td>'+value.link+'</td> <td><img src="'+banner+'" width="150" height="150"></td>  <td>'+value.qr_code+'</td> <td><button type="button" class="btn btn-success EditContent" data-id="'+value.id+'" data-title="'+value.title+'" data-description="'+value.description+'" data-link="'+value.link+'" data-banner="'+banner+'" data-qr_code="'+value.qr_code+'" data-toggle="modal" data-target="#contentModal"> Edit </button>  <button type="button" class="btn btn-danger deleteContent" data-id="'+value.id+'"> Delete </button></td> </tr>'
                });
				$('#live_data').html(html);  
            }  
        });  
    }  
    fetch_data();  

    $(document).on("click", ".EditContent", function() {

        $('.modal-title').text('Edit Content');

        $('#id').val($(this).attr('data-id'));
        $('#title').val($(this).attr('data-title'));
        $('#description').val($(this).attr('data-description'));
        $('#link').val($(this).attr('data-link'));
        $('#qr_code').val($(this).attr('data-qr_code'));
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
                dataType:"text",  
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