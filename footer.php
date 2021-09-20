<script>  
                    $(document).ready(function(){  
                        $(document).on('click', '#publishAPI', function (e) {
                            e.preventDefault();
                            $('.loader').show();
                            $.ajax({
                                url: 'publishapi.php',
                                type: 'POST',
                                dataType: "json",
                                cache: false,
                                success: function (data) {
                                    $('.loader').hide();
                                    if (data.status == 'success') {
                                        $('#messages').html('<div class="alert alert-success alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> '+data.message+'</div>');
                                    } else {
                                        $('#messages').html('<div class="alert alert-danger alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Success!</strong> '+data.message+'</div>');
                                    }
                                },
                                error: function (jqXHR, textStatus, errorThrown) {
                                    alert(errorThrown);
                                }
                            });
                        });

                    });  
                </script>