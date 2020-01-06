<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/javascripts/vendors.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/javascripts/scripts.bundle.js"></script>
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/none.js"></script>
<!-- Chart code -->
<script>

    var globleData = '<?php echo json_encode($getGeoLocation); ?>';
    var page = 'dashboard';
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
            {"name": "Gallery", "value":<?= $chartData['gallery']; ?>, "color": "#0D52D1"},
            {"name": "Snapshots", "value":<?= $chartData['snapshots']; ?>, "color": "#B0DE09"},
            {"name": "Video", "value":<?= $chartData['video']; ?>, "color": "#04D215"},
            {"name": "Video Recording", "value":<?= $chartData['video_recording']; ?>, "color": "#0D8ECF"}
        ],
        "startDuration": 1,
        "valueAxes": [{
                "gridColor": "#FFFFFF",
                "gridAlpha": 0.2,
                "dashLength": 0
            }],
        "gridAboveGraphs": true,
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
            "gridAlpha": 0,
            "tickPosition": "start",
            "tickLength": 20
        },
        "export": {
            "enabled": true
        }

    });

</script>
<style>
    #chartdiv {
        width: 100%;
        height: 500px;
    }
    .portlet.light {
        padding: 12px 20px 15px;
        background-color: #f2f3f8;
    }.page-content-wrapper .page-content {

        padding: 0px!important;
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
        
        <!--Box view-->
        
        <div class="row">
            <div class="m-portlet  m-portlet--unair">
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <!--begin::Total Profit-->
                    <div class="m-widget24">                     
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Contact 
                            </h4><br>
                            <?php $getCount = getProgressBarExcat($chartData['contact']); ?>
                            <span class="m-widget24__stats m--font-brand">
                                <?= $chartData['contact']; ?> of <?php echo $getCount['base_count']; ?>
                            </span>     
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-brand" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $chartData['contact']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <span class="m-widget24__number">
                            </span>
                        </div>                    
                    </div>
                    <!--end::Total Profit-->
                </div>
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <!--begin::New Feedbacks-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Calls
                            </h4><br>
                            <?php $getCount = getProgressBarExcat($chartData['call']); ?>
                            <span class="m-widget24__stats m--font-info">
                                <?= $chartData['call']; ?> of <?php echo $getCount['base_count']; ?>
                            </span>     
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-info" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $chartData['call']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <span class="m-widget24__number">
                            </span>
                        </div>      
                    </div>
                    <!--end::New Feedbacks--> 
                </div>
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <!--begin::New Orders-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Messages
                            </h4><br>
                            <?php $getCount = getProgressBarExcat($chartData['message']); ?>
                            <span class="m-widget24__stats m--font-danger">
                                <?= $chartData['message']; ?> of <?php echo $getCount['base_count']; ?>
                            </span>     
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-danger" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $chartData['message']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <span class="m-widget24__number">
                            </span>
                        </div>      
                    </div>
                    <!--end::New Orders--> 
                </div>
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Social Media
                            </h4><br>
                            <?php $getCount = getProgressBarExcat($chartData['social_media']); ?>
                            <span class="m-widget24__stats m--font-oragne">
                                <?= $chartData['social_media']; ?> of <?php echo $getCount['base_count']; ?>
                            </span>     
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-oragne" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $chartData['social_media']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <span class="m-widget24__number">
                            </span>
                        </div>      
                    </div>
                    <!--end::New Users--> 
                </div>
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Gallery
                            </h4><br>
                            <?php $getCount = getProgressBarExcat($chartData['gallary']); ?>
                            <span class="m-widget24__stats m--font-light-blue">
                                <?= $chartData['gallary']; ?> of <?php echo $getCount['base_count']; ?>
                            </span>     
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-light-blue" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $chartData['gallary']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <span class="m-widget24__number">
                            </span>
                        </div>      
                    </div>
                    <!--end::New Users--> 
                </div>
                <div class="col-md-12 col-lg-4 col-xl-3">
                    <!--begin::New Users-->
                    <div class="m-widget24">
                        <div class="m-widget24__item">
                            <h4 class="m-widget24__title">
                                Videos
                            </h4><br>
                            <?php $getCount = getProgressBarExcat($chartData['video']); ?>
                            <span class="m-widget24__stats m--font-success">
                                <?= $chartData['video']; ?> of <?php echo $getCount['base_count']; ?>
                            </span>     
                            <div class="m--space-10"></div>
                            <div class="progress m-progress--sm">
                                <div class="progress-bar m--bg-success" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $chartData['video']; ?> " aria-valuemin="0" aria-valuemax="100"></div>
                            </div>

                            <span class="m-widget24__number">
                            </span>
                        </div>      
                    </div>
                    <!--end::New Users--> 
                </div>
            </div>
        </div>
        
        <!--Chart and Table Section-->
        <div>
            <div class="row">
                <div class="col-lg-7 col-md-12 col-xs-12">
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
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-xs-12">
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
                                    <!-- <div class="col-md-6 col-sm-6 col-xs-12"> -->
                                    <table class="table table-striped table-bordered table-hover tb" id="application_table">
                                        <thead class="heading portlet-title" style="    background-color: #f4f3f8;color: black; padding: 5px; text-align: center;">
                                            <tr role="row" class="heading portlet-title" >
                                                <th style="padding: 10px;">No</th>
                                                <th style="padding: 10px;">Application</th>
                                                <th style="padding: 10px;">Total</th>
                                                <th style="padding: 10px;">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            foreach ($chartData as $key => $value) {
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$i; ?></td>
                                                    <td><?php echo str_replace('_', ' ', ucfirst($key)); ?></td>
                                                    <td><?php echo $value; ?></td>
                                                    <td><a href="<?= affiliate_url(); ?>user/<?= $key; ?>/<?= $user_id; ?>" class="btn green-haze" 
                                                           style="background-color: #12b2f1;border-color: #12b2f1;"> See All </a>
                                                    </td>
                                                </tr>
                                            <?php }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        
        <!--Pie charts of message call and social medai-->
        
        <div class="row">
            <div class="col-lg-4 col-md-12 col-xs-12">
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light activity-box-bg">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Call</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="m-portlet__body">
                                        <div class="m-widget16">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="m-widget16__head">
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__sceduled">
                                                                Type
                                                            </span>                          
                                                            <span class="m-widget16__amount m--align-right">
                                                                Total
                                                            </span>                  
                                                        </div>
                                                    </div>
                                                    <div class="m-widget16__body">
                                                        <!--begin::widget item-->
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/call/'.$user_id.'/incoming';?>" target="_blank">Incoming</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-brand">
                                                                <?php echo $getCallType['incoming']; ?>
                                                            </span>                  
                                                        </div>

                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/call/'.$user_id.'/outgoing';?>" target="_blank">Outgoing</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-accent">
                                                                <?php echo $getCallType['outgoing']; ?>
                                                            </span>                  
                                                        </div>
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/call/'.$user_id.'/missedcall';?>" target="_blank">Misscall</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-danger">
                                                                <?php echo $getCallType['missedcall']; ?>
                                                            </span>                  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="m-widget16__stats">
                                                        <div class="m-widget16__visual">
                                                            <div id="m_chart_support_tickets" style="height: 180px">
                                                            </div>
                                                        </div>
                                                        <div class="m-widget16__legends">
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet m--bg-info" style="background-color:#1e92e4 !important;"></span>
                                                                <span class="m-widget16__legend-text"><?php echo $getCallType['incoming']; ?> <a href="<?php echo affiliate_url().'user/call/'.$user_id.'/incoming';?>" target="_blank">Incoming</a></span>
                                                            </div>
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet m--bg-accent" style="background-color:#62bb68 !important;"></span>
                                                                <span class="m-widget16__legend-text"><?php echo $getCallType['outgoing']; ?> <a href="<?php echo affiliate_url().'user/call/'.$user_id.'/outgoing';?>" target="_blank">Outgoing</a></span>
                                                            </div>
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet m--bg-danger" style="background-color:#da1b59 !important;"></span>
                                                                <span class="m-widget16__legend-text"><?php echo $getCallType['missedcall']; ?> <a href="<?php echo affiliate_url().'user/call/'.$user_id.'/missedcall';?>" target="_blank">Misscall</a> </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                   
                                            </div>               
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-xs-12">
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light activity-box-bg">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Message</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="m-portlet__body">
                                        <div class="m-widget16">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="m-widget16__head">
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__sceduled">
                                                                Type
                                                            </span>                          
                                                            <span class="m-widget16__amount m--align-right">
                                                                Total
                                                            </span>                  
                                                        </div>
                                                    </div>
                                                    <div class="m-widget16__body">
                                                        <!--begin::widget item-->
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/message/'.$user_id.'/sent';?>" target="_blank">Sent</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-brand">
                                                                <?php echo $getMessageType['sent']; ?>
                                                            </span>                  
                                                        </div>
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/message/'.$user_id.'/inbox';?>" target="_blank">Inbox</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-accent">
                                                                <?php echo $getMessageType['inbox']; ?>
                                                            </span>                  
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="m-widget16__stats">
                                                        <div class="col">
                                                            <div id="m_chart_support_tickets1" class="m-widget14__chart" style="height: 160px">
                                                            </div>
                                                        </div>
                                                        <div class="m-widget16__legends">
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet  m--bg-accent"></span>
                                                                <span class="m-widget16__legend-text"><?php echo $getMessageType['inbox']; ?> <a href="<?php echo affiliate_url().'user/message/'.$user_id.'/inbox';?>" target="_blank">Inbox</a></span>
                                                            </div>
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet m--bg-info"></span>
                                                                <span class="m-widget16__legend-text"> <?php echo $getMessageType['sent']; ?> <a href="<?php echo affiliate_url().'user/message/'.$user_id.'/sent';?>" target="_blank">Sent</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                   
                                            </div>                
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-xs-12">
                <div class="profile-content">
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PORTLET -->
                            <div class="portlet light activity-box-bg">
                                <div class="portlet-title">
                                    <div class="caption caption-md">
                                        <i class="icon-bar-chart theme-font hide"></i>
                                        <span class="caption-subject font-blue-madison bold uppercase">Social Media</span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="m-portlet__body">
                                        <div class="m-widget16">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="m-widget16__head">
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__sceduled">
                                                                Type
                                                            </span>                          
                                                            <span class="m-widget16__amount m--align-right">
                                                                Total
                                                            </span>                  
                                                        </div>
                                                    </div>
                                                    <div class="m-widget16__body">
                                                        <!--begin::widget item-->
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/social_media/'.$user_id.'/1';?>" target="_blank">Whatsapp</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-brand">
                                                                <?php echo $getSocialype['whatsapp']; ?>
                                                            </span>                  
                                                        </div>
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/social_media/'.$user_id.'/2';?>" target="_blank">Facebook</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-accent">
                                                                <?php echo $getSocialype['facebbox']; ?>
                                                            </span>                  
                                                        </div>
                                                        <div class="m-widget16__item">                   
                                                            <span class="m-widget16__date">
                                                                <a href="<?php echo affiliate_url().'user/social_media/'.$user_id.'/3';?>" target="_blank">Gmail</a>
                                                            </span>                                      
                                                            <span class="m-widget16__price m--align-right m--font-danger">
                                                                <?php echo $getSocialype['gmail']; ?>
                                                            </span>                  
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="m-widget16__stats">
                                                        <div class="m-widget16__visual">
                                                            <div id="m_chart_support_tickets2" style="height: 180px">
                                                            </div>
                                                        </div>
                                                        <div class="m-widget16__legends">
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet m--bg-info" style="background-color:#25d366 !important;"></span>
                                                                <span class="m-widget16__legend-text"><?php echo $getSocialype['whatsapp']; ?> <a href="<?php echo affiliate_url().'user/social_media/'.$user_id.'/1';?>" target="_blank">Whatsapp</a></span>
                                                            </div>
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet m--bg-accent" style="background-color:#3b5998 !important;"></span>
                                                                <span class="m-widget16__legend-text"><?php echo $getSocialype['facebbox']; ?> <a href="<?php echo affiliate_url().'user/social_media/'.$user_id.'/2';?>" target="_blank">Facebook</a></span>
                                                            </div>
                                                            <div class="m-widget16__legend">
                                                                <span class="m-widget16__legend-bullet m--bg-danger" style="background-color:#dd4b39 !important;"></span>
                                                                <span class="m-widget16__legend-text"><?php echo $getSocialype['gmail']; ?> <a href="<?php echo affiliate_url().'user/social_media/'.$user_id.'/3';?>" target="_blank">Gmail</a></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                   
                                            </div>               
                                        </div>                       
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Table View of call list and message-->
        
        <div class="row">
            <div class="col-md-12" style="padding:0px; ">
                <div class="profile-content">
                    <div class="col-lg-4 col-xs-12 col-sm-12  user_mtr">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">CALL LIST</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided">
                                        <a href="<?php echo affiliate_url() . 'user/call/' . $user_id ?>" target="_blank" class="btn blue btn-outline btn-circle btn-sm">See All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                            <tr class="uppercase">
                                                <th colspan="2">No</th>
                                                <th>Name</th>
                                                <th>Number</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $j = 0;
                                            for ($i = 0; $i < count($recentFeeds['call_data']); $i++) {
                                                $j++;
                                                ?>
                                                <tr>
                                                    <td class="fit">
                                                    </td>
                                                    <td><?php echo $j; ?></td>
                                                    <td><?php echo $recentFeeds['call_data'][$i]->name; ?></td>
                                                    <td><?php echo $recentFeeds['call_data'][$i]->number; ?></td>
                                                    <td><?php echo $recentFeeds['call_data'][$i]->date; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($recentFeeds['call_data'][$i]->call_type == 'incoming') {
                                                            $class = "m-badge--info";
                                                        } else if ($recentFeeds['call_data'][$i]->call_type == 'outgoing') {
                                                            $class = "m-badge--success";
                                                        } else if ($recentFeeds['call_data'][$i]->call_type == 'missedcall') {
                                                            $class = "m-badge--danger";
                                                        }
                                                        ?>
                                                        <span class="bold theme-font <?= $class; ?> m-badge--wide"><?php echo $recentFeeds['call_data'][$i]->call_type; ?></span>
                                                    </td>
                                                </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-sm-12 user_mtr">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">MESSAGE LIST</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided">
                                        <a href="<?php echo affiliate_url() . 'user/message/' . $user_id ?>" target="_blank" class="btn blue btn-outline btn-circle btn-sm">See All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-scrollable table-scrollable-borderless">
                                    <table class="table table-hover table-light">
                                        <thead>
                                            <tr class="uppercase">
                                                <th colspan="2">No</th>
                                                <th>Name</th>
                                                <th>Number</th>
                                                <th>Date</th>
                                                <th>Type</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $j = 0;
                                            for ($i = 0; $i < count($recentFeeds['message_data']); $i++) {
                                                $j++;
                                                ?>
                                                <tr>
                                                    <td class="fit">
                                                    </td>
                                                    <td><?php echo $j; ?></td>
                                                    <td><?php echo $recentFeeds['message_data'][$i]->name; ?></td>
                                                    <td><?php echo $recentFeeds['message_data'][$i]->number; ?></td>
                                                    <td><?php echo $recentFeeds['message_data'][$i]->date; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($recentFeeds['message_data'][$i]->type == 'sent') {
                                                            $class = "m-badge--info";
                                                        } else if ($recentFeeds['message_data'][$i]->type == 'inbox') {
                                                            $class = "m-badge--success";
                                                        }
                                                        ?>
                                                        <span class="bold theme-font <?= $class; ?> m-badge--wide"><?php echo $recentFeeds['message_data'][$i]->type; ?></span>
                                                    </td>
                                                </tr>
<?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-xs-12 col-sm-12 user_mtr">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart font-dark hide"></i>
                                    <span class="caption-subject font-dark bold uppercase">Geo Location</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided">
                                        <a href="<?php echo affiliate_url() . 'user/geo_location/' . $user_id ?>" target="_blank" class="btn blue btn-outline btn-circle btn-sm">View Full map</a>
                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="grid">
                                    <div id="mapGeoRender" style="width: 100%; height: 250px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

        </div>
    </div>    
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $("#m_chart_support_tickets2").length && Morris.Donut({
            element: "m_chart_support_tickets2",
            data: [{
                    label: "Whats App",
                    value: '<?php echo $getSocialype['whatsapp']; ?>'
                }, {
                    label: "Facebook",
                    value: '<?php echo $getSocialype['facebbox']; ?>'
                }, {
                    label: "Gmail",
                    value: '<?php echo $getSocialype['gmail']; ?>'
                }],
            labelColor: "#a7a7c2",
            colors: ['#25D366', '#3B5998', '#dd4b39']
        });

        $("#m_chart_support_tickets").length && Morris.Donut({
            element: "m_chart_support_tickets",
            data: [{
                    label: "Incoming",
                    value: '<?php echo $getCallType['incoming']; ?>'
                }, {
                    label: "Outgoing",
                    value: '<?php echo $getCallType['outgoing']; ?>'
                }, {
                    label: "Misscall",
                    value: '<?php echo $getCallType['missedcall']; ?>'
                }],
            labelColor: "#a7a7c2",
            colors: ['#1e92e4', '#62bb68', '#da1b59']
        });

        $("#m_chart_support_tickets1").length && Morris.Donut({
            element: "m_chart_support_tickets1",
            data: [{
                    label: "Inbox",
                    value: '<?php echo $getMessageType['inbox']; ?>'
                }, {
                    label: "Sent",
                    value: '<?php echo $getMessageType['sent']; ?>'
                }],

            labelColor: "#a7a7c2",
            colors: [mApp.getColor("accent"), mApp.getColor("danger")]
        });

    });

</script>