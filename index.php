<html>  
    <head>  
        <title>Content</title>  
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css"> 
        <style>
           @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
            }


            body{
                min-height: 100vh;
                padding: 40px 0;
                background-color: #ecedef;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: 'Roboto', sans-serif;
                background-color: #4f018b;
            }

            .card{
                background-color: #fff;
                padding: 30px;
                max-width: 375px;
                width: 100%;
                border-radius: 20px;
            }

            .card h2{
                font-size: 27px;
                margin-bottom: 40px;
            }

            .inputs{
                display: flex;
                flex-direction: column;
                margin-bottom: 10px;
            }

            .inputs label{
                font-size: 14px;
                margin-bottom: 5px;
            }

            .inputs input{
                display: block;
                padding: 10px;
                font-size: 16px;
                border-radius: 7px;
                border: 1px solid #464277;
                background-color: #f4f8fb;
                outline: none;
            }

            .text-right{
                font-size: 16px;
                text-align: right;
                display: block;
                color: #212121;
                margin-bottom: 20px;
            }

            .btn-login{
                display: block;
                width: 100%;
                height: 40px;
                background-color: #212121;
                color: #fff;
                text-decoration: none;
                text-align: center;
                line-height: 40px;
                border-radius: 7px;
                margin-bottom: 20px;
                transition: 0.3s;
            }

            .btn-login:hover{
                transform: translateY(-5px);
                box-shadow: 2px 2px 5px rgba(0,0,0,0.4);
            }

            .text{
                display: block;
                text-align: center;
                color: #888;
                margin-bottom: 20px;
            }

            .text-long{
                color: #212121;
                margin-bottom: 20px;
            }

            .social-icons{
                display: flex;
                justify-content: space-between;
                align-items: center;
                flex-wrap: wrap;
            }

            .social-icons a{
                height: 50px;
                width: 50px;
                border-radius: 10px;
                display: flex;
                align-items: center;
                justify-content: center;
                text-decoration: none;
                transition: 0.3s;
            }

            .social-icons a:hover{
                border-radius: 50%;
                transform: translateY(-5px);
                box-shadow: 2px 2px 10px rgba(0,0,0,0.2);
            }

            .social-icons .google{
                background: #feecea;
                color: #9d4843;
            }
            .social-icons .twitter{
                background: #ecf4ff;
                color: #34a8f1;
            }
            .social-icons .facebook{
                background: #edf1fa;
                color: #5e83b0;
            }
            .social-icons .apple{
                background: #e9e9e9;
                color: #000;
            }

            .social-icons a i{
                font-size: 20px;
            }

            @keyframes big {
                from {
                    transform: scale(0.7);
                }
                
                to {
                    transform: scale(1);
                }
            }
        </style>
    </head>  
    <body>  
    
    
        <div class="card">
            <h2>Login</h2>
            <div id="messages"></div>
            <form id="submitLogin" method="post" enctype="multipart">
                <div class="inputs">
                    <label>Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div class="inputs">
                    <label>Password</label>
                    <input type="password" name="password" id="password" required>
                </div>
                <!-- <a target="_blank" href="https://youtu.be/xo9W8WQ-QVI" class="text-right">Did you forget your password?</a> -->
                <input type="hidden" name="flag" value="1">
                <button class="btn-login">Log In</button>
            </form>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
        <script>  
            $(document).ready(function(){  
                $(document).on('submit', '#submitLogin', function (e) {
                    e.preventDefault();
                    
                    var formdata = new FormData($("#submitLogin")[0]);
                    $('.loader').show();
                    $.ajax({
                        url: 'LoginUser.php',
                        type: 'POST',
                        data: formdata,
                        dataType: "json",
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function (data) {
                            $('.loader').hide(); 
                            if (data.success == 1) {
                                window.location.href = './dashboard.php';
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