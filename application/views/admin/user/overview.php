<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>

<!-- Chart code -->
<script>
    var chart = AmCharts.makeChart("chartdiv", {
        "hideCredits": true,
        "type": "serial",
        "theme": "none",
        "marginRight": 70,
        "dataProvider": [
            {"name": "Contacts", "value":<?= $chartData['contact']; ?>, "color": "#FF0F00"},
            {"name": "Calls", "value":<?= $chartData['call']; ?>, "color": "#FF6600"},
            {"name": "Messages", "value":<?= $chartData['message']; ?>, "color": "#FF9E01"},
            {"name": "Social Media", "value":<?= $chartData['social_media']; ?>, "color": "#FCD202"},
            {"name": "Gallary", "value":<?= $chartData['gallary']; ?>, "color": "#0D52D1"},
            {"name": "Scrren Photo", "value":<?= $chartData['screen_photo']; ?>, "color": "#B0DE09"},
            {"name": "Video", "value":<?= $chartData['video']; ?>, "color": "#04D215"},
            {"name": "Video Screen", "value":<?= $chartData['screen_video']; ?>, "color": "#0D8ECF"}
        ],
        "startDuration": 1,
        "graphs": [{
                "balloonText": "<b>[[category]]: [[value]]</b>",
                "fillColorsField": "color",
                "fillAlphas": 0.9,
                "lineAlpha": 0.2,
                "type": "column",
                "valueField": "value"
            }],
        "chartCursor": {
            "categoryBalloonEnabled": false,
            "cursorAlpha": 0,
            "zoomable": true
        },
        "categoryField": "name",
        "categoryAxis": {
            "gridPosition": "start",
            "labelRotation": 0,
        },
        "export": {
            "enabled": true
        }

    });
</script>
<style>
    #chartdiv {
        width: 60%;margin: 0 auto;
        height: 500px;
    }

    .amcharts-export-menu-top-right {
        top: 10px;
        right: 0;
    }
</style>
<div class="portlet light portlet-fit bordered">
    <div class="portlet-title">
        <div class="col-md-3" style="padding-left: 0">
            <div class="caption">
                <i class="icon-settings font-green-haze"></i>
                <span class="caption-subject font-green-haze sbold uppercase"> User Information </span>
            </div>
        </div>
        <div class="actions usename">
            <?php echo $user_name; ?>
        </div>
    </div>
    <div class="portlet-body">
        <div class="row">

            <!--<div class="col-md-3">-->
            <?php //echo userSidebar('overview',$user_name,$user_id); ?>
            <!--</div>-->

            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 red" href="#">
                    <div class="visual">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span><?= $chartData['contact']; ?></span>
                        </div>
                        <div class="desc"> Contacts </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2  green" href="#" style="background-color:#FF6600;color: white; ">
                    <div class="visual">
                        <i class="fa fa-phone" aria-hidden="true"></i>

                    </div>
                    <div class="details">
                        <div class="number">
                            <span><?= $chartData['call']; ?></span></div>
                        <div class="desc">Calls  </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 green" href="#" style="background-color: #FF9E01; color: white;">
                    <div class="visual">
                        <i class="fa fa-commenting" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span><?= $chartData['message']; ?></span>
                        </div>
                        <div class="desc"> Messages </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#" style="background-color: #FCD202; color: white;">
                    <div class="visual">
                        <i class="fa fa-share-square-o" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span><?= $chartData['social_media']; ?></span></div>
                        <div class="desc"> Social Media </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#" style="background-color: #0D52D1; color: white;">
                    <div class="visual">
                        <i class="fa fa-picture-o" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span><?= $chartData['gallary']; ?></span></div>
                        <div class="desc"> Galleries </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <a class="dashboard-stat dashboard-stat-v2 purple" href="#" style="background-color: #0D8ECF; color: white;">
                    <div class="visual">
                        <i class="fa fa-file-video-o" aria-hidden="true"></i>
                    </div>
                    <div class="details">
                        <div class="number">
                            <span><?= $chartData['video']; ?></span></div>
                        <div class="desc"> Videos </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-12">
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light activity-box-bg">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Your Activity</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div id="chartdiv"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-offset-2 col-md-7 col-xs-12 col-sm-12" style="    left: 50px;">
                            <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
                            <table class="table table-striped table-bordered table-hover tb" id="application_table">
                                <thead class="heading portlet-title" style="    background-color: #7d8794;color: white; padding: 5px; text-align: center;">
                                    <tr role="row" class="heading portlet-title" >
                                        <th style="padding: 10px;">No</th>
                                        <th style="padding: 10px;">Application</th>
                                        <th style="padding: 10px;">Total</th>
                                        <th style="padding: 10px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
<!--                                    <tr>
                                        <td>1</td>
                                        <td>Messagesd</td>
                                        <td>25</td>
                                        <td><a href="javascript:;" class="btn green-haze" style="background-color: #12b2f1;border-color: #12b2f1;"> See All </a></td>
                                    </tr>-->
                                    <?php
                                        $i=0;
                                        foreach ($chartData as $key => $value){ ?>
                                        <tr>
                                            <td><?php echo ++$i;?></td>
                                            <td><?php echo str_replace('_',' ', $key);?></td>
                                            <td><?php echo $value; ?></td>
                                            <td><a href="<?= admin_url(); ?>user/<?= $key; ?>/<?= $user_id; ?>" class="btn green-haze" 
                                                   style="background-color: #12b2f1;border-color: #12b2f1;"> See All </a>
                                            </td>
                                        </tr>
                                       <?php }
                                    ?>
                                </tbody>
                            </table>
                            <!-- </div> -->


                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>