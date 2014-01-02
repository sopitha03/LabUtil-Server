<?php
include_once 'common.php';
include_once 'config.php';
require_once 'classes/client.php';
$client = new client();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $lang['MENU_PC'] . ' | ' . $lang['PAGE_TITLE']; ?></title>
        <meta name="description" content="<?php echo $lang['PAGE_DESCRIPTION']; ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.v1.css">
        <link rel="stylesheet" href="css/font.css" cache="false">
        <!--[if lt IE 9]> <script src="js/ie/respond.min.js" cache="false"></script> <script src="js/ie/html5.js" cache="false"></script> <script src="js/ie/fix.js" cache="false"></script> <![endif]-->
    </head>
    <body>
        <section class="hbox stretch"> <!-- .aside -->
            <aside class="bg-black aside-sm" id="nav">
                <section class="vbox">
                    <header class="bg-black dker nav-bar"> <a class="btn btn-link visible-xs" data-toggle="class:nav-off-screen" data-target="body"> <i class="icon-reorder"></i> </a> <a href="#" class="nav-brand" data-toggle="fullscreen"><?php echo $lang['SITE_NAME']; ?></a> <a class="btn btn-link visible-xs" data-toggle="class:show" data-target=".nav-user"> <i class="icon-comment-alt"></i> </a> </header>
                    <footer class="footer bg-gradient hidden-xs"> <a href="modal.lockme.html" data-toggle="ajaxModal" class="btn btn-sm btn-link m-r-n-xs pull-right"> <i class="icon-off"></i> </a> <a href="#nav" data-toggle="class:nav-vertical" class="btn btn-sm btn-link m-l-n-sm"> <i class="icon-reorder"></i> </a> </footer>
                    <section>
                        <?php include("asidemenu.php"); ?>
                    </section>
                </section>
            </aside>
            <!-- /.aside --> <!-- .vbox -->
            <section id="content">
                <section class="vbox">
                    <header class="header bg-black bg-gradient">
                        <ul class="nav nav-tabs">      
                            <li class="navbar-text"> <button class="btn btn-success btn-sm"><?PHP echo $lang['CLINET_DETAILS']; ?></button></li>     
                            
                                <div class="row text-sm wrapper">
                                    <div class="col-sm-5 m-b-xs">
                                        <div class="btn-group">
                                            <button class="btn btn-success btn-sm"><?PHP echo $lang['CLIENT_SELECT_LAB']; ?></button>
                                            <button class="btn bg-success btn-sm dropdown-toggle" data-toggle="dropdown"><span class="caret bg-success"></span></button>
                                            <ul class="dropdown-menu bg-white animated fadeInUp">
                                                <?php
                                                $client->get_list_of_labs();
                                                ?>
                                            </ul></div>

                                    </div>

                                    <div class="col-sm-3">
                                        <form method="get">
                                            <div class="input-group">

                                                <input type="text" class="input-sm form-control" placeholder="<?php echo $lang['CLIENT_SEARCH_PLACEHOLDER'];?>" name="mac">
                                                <span class="input-group-btn">
                                                    <button class="btn btn-sm btn-white" type="submit"><?PHP echo $lang['CLIENT_SEARCH_BUTTON'];?></button>

                                                </span>

                                            </div></form>
                                    </div>
                                </div>
                        </ul>
                    </header>
                    <section class="scrollable wrapper">
                        <div class="tab-content">
                            <section class="tab-pane active" id="wizard">
                               
                                <?php
                                if (isset($_GET['group'])) {
                                    echo '
			  <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
              <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_OK'].'</strong> ' . $_GET['group'] . '"'.$lang['CLIENT_MESSAGE_GROUP'].' </div>
            
			  ';
                                }
                                if (isset($_GET['mac'])) {
                                    echo '
			  <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
              <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_OK'].'</strong>' . $_GET['mac'] . ' "'.$lang['CLIENT_MESSAGE_GROUP'].' </div>
            
			  ';
                                }

                                if (isset($_GET['changeGr'])) {
                                    $mac = $_GET['macID'];
                                    $gr = $_GET['changeGr'];
                                    $result_option = mysqli_query($con, "UPDATE  `profile` SET  `group` =  '$gr' WHERE  `mac` =  '$mac'");
                                    $result_option2 = mysqli_query($con, "UPDATE  `testdata` SET  `group` =  '$gr' WHERE  `mac` =  '$mac'");
                                    echo '
			  <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert"><i class="icon-remove"></i></button>
              <i class="icon-ok-sign"></i><strong>'.$lang['LAB_MESSAGE_OK'].'</strong>' . $_GET['macID'] . '"'.$lang['CLIENT_MESSAGE_CHANGE_GROUP'].' '.$gr.' </div>
            
			  ';
                                }
                                ?>


                            
                                <div class="table-responsive ">
                                    <table class="table table-striped b-t text-sm">
                                        <thead>
                                            <tr>
                                                <th width="20"><input type="checkbox"></th>
                                                <th class="th-sortable" data-toggle="class"><?php echo $lang['CLIENT_TABLE_MAC'];?> <span class="th-sort"> <i class="icon-sort-down text"></i> <i class="icon-sort-up text-active"></i> <i class="icon-sort"></i> </span> </th>
                                                <th><?php echo $lang['CLIENT_TABLE_NAME'];?></th>
                                                <th><?php echo $lang['CLIENT_TABLE_IP'];?></th>
                                                <th><?php echo $lang['CLIENT_TABLE_GROUP'];?></th>
                                                <th><?php echo $lang['CLIENT_TABLE_JOIN'];?></th>
                                                <th width="100"><?php echo $lang['CLIENT_TABLE_PROFILE'];?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="animated fadeInUp">
                                            <?php
                                            if (isset($_GET['group'])) {
                                                $client->get_list_of_pc_by_group($_GET['group']);
                                            }
                                            if (isset($_GET['mac'])) {
                                                 $client->get_lis_of_pc_by_mac($_GET['mac']);
                                            }
                                            if (!isset($_GET['group']) && !isset($_GET['mac'])) {
                                                $client->get_lis_of_pc();
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <footer class="panel-footer bg-light dker">
                                    <div class="row">
                                        <div class="col-sm-4 hidden-xs">                  
                                        </div>
                                        <div class="col-sm-4 text-center "> <small class="inline m-t-sm m-b-sm"><?php echo$lang['CLINET_TABLE_FOOTER_SHOWING']. $client->getStart().' - '.$client->getEnd().$lang['CLINET_TABLE_FOOTER_OF']. $client->getTotal().$lang['CLINET_TABLE_FOOTER_ITEMS'];?> </small> </div>
                                        <div class="col-sm-4 text-right text-center-xs">
                                            <ul class="btn-warning pagination pagination-sm m-t-none m-b-none">
                                                <li class="btn-warning"><a href="?back"><i class=" icon-chevron-left"></i></a></li>
                                                
                                                <li class="btn-warning"><a href="?next"><i class="icon-chevron-right"></i></a></li>
                                            </ul>
                                        </div>
                                        <?php
                                        if(isset($_GET['next'])){
                                            $client2=  new client();
                                            $client2->setnext();
                                        }
                                        ?>
                                    </div>
                                </footer>
                            </section>
                        </div>
                    </section>
                </section>
            </section>
            <!-- /.vbox --> </section>
        <script>
            $(document).ready(function() {
                $('#example').dataTable({
                    "bProcessing": true,
                    "bServerSide": true,
                    "sAjaxSource": "include/getpc.php"
                });
            });
        </script>
        <script src="css/app.v1.js"></script> <!-- Bootstrap --> <!-- app --> <!-- fuelux --> <!-- datepicker --> <!-- slider --> <!-- file input --> <!-- combodate --> <!-- parsley --> <!-- select2 -->
    </body>
</html>