<div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="https://bryanrojasq.wordpress.com">
                        <img class="logo" src="./uploads/stc_icon.png" alt="LOGO">
                    </a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="pt-5">
                        <div id="messages1"></div>
                        <button type="button" id="publishAPI" class="btn btn-white">
                            Publish
                        </button>
                    </li>          
                    <li>
                        
                        <a href="profile.php" id="profile">Profile</a>
                    </li>          
                    <li class="dropdown">
                    <a href="logout.php" id="logout">Logout</a>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <div class="collapse navbar-collapse navbar-ex1-collapse">
                    <ul class="nav navbar-nav side-nav">
                        <li class="active"><a href="./dashboard.php">Dashboard</a></li>
                        <?php if($_SESSION["role"] == 1){ ?>
                            <li ><a href="./users_list.php">User</a></li>
                        <?php } ?>                          
                        <li><a href="./content_list.php">Content</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">

                