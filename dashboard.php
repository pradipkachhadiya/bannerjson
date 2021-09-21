<?php

session_start();
if (empty($_SESSION["is_login"])) {
    header("location:./");
}

$connect = mysqli_connect("localhost", "root", "vktCcPUTLaCxiqVPmvLw","content_stc");

$sql = "SELECT * FROM tbl_users WHERE is_deleted=0";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));;
$total_users = $result->num_rows;

$sql = "SELECT * FROM tbl_content WHERE is_deleted=0";
$result = mysqli_query($connect, $sql) or die(mysqli_error($connect));;
$total_content = $result->num_rows;
?>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.2/css/font-awesome.min.css">
    <link rel="stylesheet" href="./css/custom.css">
</head>

<body>
    <input type="hidden" class="token" value="<?php echo md5($_SESSION["email"]) ?>">
    <?php include("header.php") ?>
    <!-- Page Heading -->
    <div id="messages"></div>
    <div class="row" id="main">
        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
                <div class="row">
                    <div class="fontsty">
                        <h4>Users</h4>
                        <h2><?php echo $total_users ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-2 mt-4">
            <div class="inforide">
                <div class="row">
                    <div class="fontsty">
                        <h4>Content</h4>
                        <h2><?php echo $total_content ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
    </div>
    <!-- /#page-wrapper -->
    </div><!-- /#wrapper -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    <?php include("footer.php") ?>
</body>

</html>