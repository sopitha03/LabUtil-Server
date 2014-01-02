
<?php
include_once 'common.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $lang['PAGE_TITLE']; ?></title>
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.v1.css">
        <link rel="stylesheet" href="css/font.css" cache="false">
        <!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
    </head>
    <body>
        <section class="hbox stretch"> <!-- .aside -->
            <aside class="bg-black dker aside-sm" id="nav">
                <section class="vbox">
                    <header class="dker nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
                    <footer class="footer bg-gradient hidden-xs"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> <i class="icon-reorder"></i> </a> </footer>
                    <section> <!-- user -->
                        <?php include("asidemenu.php"); ?>
                        <!-- / nav --> <!-- note -->
                        <div class="bg-danger wrapper hidden-vertical animated rollIn text-sm"> <a href="#" data-dismiss="alert" class="pull-right m-r-n-sm m-t-n-sm"><i class="icon-close icon-remove "></i></a> <?PHP echo $lang['WELCOME_MESSAGE']; ?></div>
                        <!-- / note --> </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="vbox">
                    <header class="header bg-white b-b">
                        <p><?PHP echo $lang['WELCOME_MESSAGE2']; ?></p>
                    </header>
                    <section class="scrollable wrapper">
                        <div class="row">
                           
                            <section class="animated fadeInUp col-lg-8">
                                <?php
                                $today = date("Y-m-d");
                                $result_work = mysqli_query($con, "SELECT * FROM `profile` where `date` = '$today' LIMIT 0,3");
                                $row_work = mysqli_num_rows($result_work);
                                if ($row_work > 0) {
                                    echo'
                                <section class="panel no-borders hbox">
                                  <aside class="bg-info lter r-r text-left v-middle clearfix">
                                    <div class="wrapper h3">
                                      <p class="text-muted"><i class="icon-user"></i>'.$lang['INDEX_PROFILE_HEADER'].'</p>
                                    </div>
                                  </aside>
                                  <aside>
                                    <div class="pos-rlt"> <span class="arrow left hidden-xs"></span>
                                      <div class="panel-body">
                                        <div class="clearfix m-b">
                                          <div class="clear"><strong>' . $row_work .$lang['INDEX_PROFILE_CREATED']. '</strong></div> <i class="icon-group"></i>  
                                        </div>
                                        </div>

                                    </div>
                                  </aside>
                                </section>';
                                }
                                ?>
                                <section class="panel no-borders hbox animated fadeInLeft ">
                                    <aside >
                                        <div class="pos-rlt "> <span class="arrow right hidden-xs"></span>
                                            <div class="panel-body">
                                                <?php
                                                $result_work = mysqli_query($con, "SELECT * FROM `pcworkinghours` LIMIT 0,1");
                                                while ($row_work = mysqli_fetch_array($result_work)) {
                                                    echo
                                                    '<div class="clearfix m-b v-middle"> 
                                                     <small class="text-muted pull-right">' . $row_work['date'] . ' ' . $row_work['time'] . '</small> 
                                                     <a href="#" class="thumb-sm pull-left m-r">
                                                     </a>
                                                     <div class="clear">
                                                     </div> ';
                                                }
                                                $result_work = mysqli_query($con, "SELECT * FROM `pcworkinghours`");
                                                $row_work = mysqli_num_rows($result_work);

                                                echo '<small class="wrapper h4"> ' . $row_work .$lang['INDEX_UPDATE_MESSAGE']. '</small> </div>
                                                </div>';
                                                
                                                //every minute update working time of every pc in our list
	$today_date=date("Y-m-d");
	$today_time=date("H:i:s");
	$result_mac = mysqli_query($con,"SELECT * FROM profile");
	while($row_mac = mysqli_fetch_array($result_mac))
	{
		$mac=$row_mac['mac'];
		$c=0;
		$result_time = mysqli_query($con,"SELECT * FROM  testdata where mac='$mac'");
		while($row_time = mysqli_fetch_array($result_time))
		{
			$timeArray = explode (":", $row_time['on_time'] );
			$x=($timeArray[0]*60*60);
			$y=($timeArray[1]*60);
			$z=($timeArray[2]);
			$w=($x+$y+$z);
			$c+=$w;
		}
		$work=gmdate("H:i:s", $c);
		$result_check = mysqli_query($con,"SELECT * FROM  pcworkinghours where mac='$mac'");
		$row_check = mysqli_num_rows($result_check);
		//check for if it is available  in pcworking list 
		if($row_check > 0){
			$result_update_time = mysqli_query($con,"UPDATE  `pcworkinghours` SET  `date` =  '$today_date',`time` =  '$today_time',work='$work'  WHERE  `mac` =  '$mac'");
			//echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Update '.date('Y-m-d H:i:s').'</td></tr>';
		}
		else{
			$result_insert_time = mysqli_query($con,"INSERT INTO  `pcworkinghours` (`mac` ,`work` ,`date` ,`time`)VALUES ('$mac',  '$work',  '$today_date',  '$today_time')");
			//echo '<tr><td ALIGN="CENTER"> '.$mac.'</td><td ALIGN="CENTER">'.gmdate("H:i:s", $c).'</td><td ALIGN="CENTER">Insert '.date('Y-m-d H:i:s').'</td></tr>';
		}
	}
                                                ?>
                                            </div>
                                    </aside>
                                    <aside class="bg-success clearfix lter r-r text-right v-middle">
                                        <div class="wrapper h3 font"> <i class="icon-bullhorn"></i> <?PHP echo $lang['INDEX_UPDATE_HEADER'];?> </div>
                                    </aside>
                                </section>

                            </section>
                            
                            <section class="col-lg-4 scrollable animated fadeInRight">
                                
                                <section class="panel bg-gradient no-borders">
                                    <header class="header text-center bg-warning "><p class="h4"><i class="icon-windows"></i><span class="h4"><?PHP echo $lang['INDEX_ONLINE_HEADER'];?></span></p></header>
                                    <div class="panel-body"> 
                                        <?php
                                        $today = date("Y-m-d");
                                        $timeArray = explode(":", date("H:i:s"));
                                        $x = ($timeArray[0] * 60 * 60);
                                        $y = ($timeArray[1] * 60) - 2 * 60;
                                        $z = ($timeArray[2]);
                                        $w = ($x + $y + $z);
                                        $update_time = gmdate("H:i:s", $w);
                                        $result = mysqli_query($con, "SELECT * FROM testdata where date = '$today' and ( out_time  > '$update_time'or in_time >'$update_time')");
                                        $number_of_online = mysqli_num_rows($result);
                                        ?>
                                        <div class="text-center padder m-t"> <span class="h1"><i class="icon-desktop text-muted"></i> <?php echo $number_of_online; ?></span> </div>
                                    </div>
                                    <footer class="panel-footer">
                                        <div class="row">
                                            <?PHP
                                            $result_option = mysqli_query($con, "SELECT * FROM  `labprofile`");
                                            $today = date("Y-m-d");
                                            $timeArray = explode(":", date("H:i:s"));
                                            $x = ($timeArray[0] * 60 * 60);
                                            $y = ($timeArray[1] * 60) - 2 * 60;
                                            $z = ($timeArray[2]);
                                            $w = ($x + $y + $z);
                                            $update_time = gmdate("H:i:s", $w);

                                            while ($row_option = mysqli_fetch_array($result_option)) {
                                                $grop = $row_option['name'];
                                                $result = mysqli_query($con, "SELECT * FROM  `testdata` WHERE  `group` =  '$grop' AND `date`='$today' AND ( `out_time`  > '$update_time'OR `in_time` >'$update_time')");
                                                $number_of_online = mysqli_num_rows($result);
                                                echo ' <div class="col-xs-3"><span class="label bg-black h4 block">' . $grop . '<span class="block">' . $number_of_online . '</span></span> </div>';
                                            }
                                            ?>


                                        </div>
                                    </footer>
                                </section>
                                <section class="panel no-borders bg-gradient bg-success">
                                    <header class="header text-center bg-warning"><p class="h4 text-white"><i class="icon-desktop"></i><?PHP echo $lang['INDEX_CLIENT_HEADER'];?> </p></header>
                                    <ul class="list-group list-group-flush no-borders">
                                        <?php
                                        $number = 01;
                                        $result_option = mysqli_query($con, "SELECT * FROM  `labprofile`");
                                        while ($row = mysqli_fetch_array($result_option)) {
                                            $group = $row['name'];
                                            $result2 = mysqli_query($con, "SELECT * FROM   `profile` WHERE `group` = '$group'");
                                            $rows = mysqli_num_rows($result2);
                                            mysqli_query($con, "UPDATE `labprofile` SET `noofpc` = '$rows' WHERE `name` = '$group'");
                                            echo ' <li class="list-group-item h5 no-borders"> <span class="label bg-dark pull-right">' . $rows . '</span> <span class="label bg-dark">' . number_format($number++, 00) . '</span> <span class="label bg-dark">' . $row['name'] . '</span> </li>';
                                        }
                                        ?>
                                   </ul>
                               </section>
                                
                                
                                <section class="panel no-borders bg-gradient ">
                                    <header class="header text-center bg-warning"><p class="h4"><i class="icon-male"></i><?PHP echo $lang['INDEX_USER_HEADER'];?></p></header>
                                    <ul class="list-group list-group-flush alt no-borders ">
                                        <?php
                                        $number = 01;
                                        $result_option = mysqli_query($con, "SELECT * FROM  `levels`");
                                        while ($row = mysqli_fetch_array($result_option)) {
                                            $group = $row['id'];
                                            $result2 = mysqli_query($con, "SELECT * FROM   `labusers` WHERE `level` = '$group'");
                                            $rows = mysqli_num_rows($result2);
                                             echo ' <li class="list-group-item h5  no-borders"> <span class="label bg-dark  pull-right">' . $rows . '</span> <span class="label bg-dark">' . number_format($number++, 00) . '</span> <span class="label bg-dark">' . $row['name'] . '</span></li>';
                                           }
                                        ?>
                                   </ul>
                               </section>
                                
                            </section>
                        </div>
                    </section>
                </section>
                <a href="#" class="hide nav-off-screen-block" data-toggle="class:nav-off-screen" data-target="body"></a> </section>
            <!-- /.vbox --> </section>
        <script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- Sparkline Chart --> <!-- App -->
    </body>
</html>