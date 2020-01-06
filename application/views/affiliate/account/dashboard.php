<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/javascripts/vendors.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/javascripts/scripts.bundle.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>public/assets/javascripts/Chart.bundle.min"></script>
<script type="text/javascript" src="https://colorlib.com/polygon/cooladmin/vendor/jquery-3.2.1.min.js"></script>


<style>
    .progress-bar.m--bg-lghter-blue {
        background: #19b7eb;
    }
    .portlet.light {
        padding: 12px 20px 15px;
        background-color: #f2f3f8;
    }.page-content-wrapper .page-content {

        padding: 0px!important;
    }
    .m--bg-brand{
        background-color:#04f9ac !important;
    }
    .m--font-brand{
        color:#1e92e4 !important;
    }
    .m--bg-info{
        background-color:#ff8832 !important;
    }
    .m--font-info{
        color: #62bb68 !important;
    }
    .m--bg-danger{
        background-color:#fe3260 !important;
    }
    .m--font-danger {
        color: #da1b59 !important;
    }
    .m--bg-success{
        background-color:#f6614c !important
    }
    .m--font-success {
        color: #dd4b39 !important;
    }
    .m--bg-blue{
        background-color:#3b5998 !important;
    }
    .m--font-blue {
        color: #3b5998 !important;
    }
    .progress-bar.m--bg-gmail {
        background: #f8644f;
    }
    .m--bg-green{
        background-color:#25d366 !important;
    }
    .m--font-green {
        color: #25d366 !important;
    }
    .progress-bar.m--bg-sent {
        background: #32c3f3;
    }
    .progress-bar.m--bg-light-blue {
        background:#fe6732 !important;
    }
    span.m-widget24__stats.m--font-light-blue{
        color:#00c5dc !important;
    }
    span.m-widget24__stats.m--font-oragne {
        color: #f4516c !important;
    }
    .progress-bar.m--bg-oragne {
        background: #34b360 !important;
    }
    .progress-part {
        float: left;
        width: 100%;
        margin-left: 20px;
        margin-right: 20px;
        background: transparent;
    }
</style>
<div class="portlet light portlet-fit bordered monitor_dash">

    <div class="portlet-body">

        <!--start of progress part -->

        <div class="row">
            <div class="progress-part m-portlet  m-portlet--unair">

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <span><img src="<?php echo base_url() ?>public/assets/images/incoming call.png" class="img-responsive" alt=" " /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllCalls['incoming']); ?>
                            <p class="card-category">Incoming Call</p>
                            <h3 class="card-title"> <?= $overAllCalls['incoming']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-brand" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllCalls['incoming']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon ">
                            <div class="card-icon card-2">
                                <span><img src="<?php echo base_url() ?>public/assets/images/ooutgoing.png" class="img-responsive" alt=" " /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllCalls['outgoing']); ?>
                            <p class="card-category">Outgoing Call</p>
                            <h3 class="card-title"><?= $overAllCalls['outgoing']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-info" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllCalls['outgoing']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon ">
                            <div class="card-icon card-3">
                                <span><img src="<?php echo base_url() ?>public/assets/images/missdcall.png" class="img-responsive" alt=" " /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllCalls['missedcall']); ?>
                            <p class="card-category">Missed Call</p>
                            <h3 class="card-title"><?= $overAllCalls['missedcall']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-danger" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllCalls['missedcall']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon ">
                            <div class="card-icon card-4">
                                <span><img src="<?php echo base_url() ?>public/assets/images/sent.png" class="img-responsive" alt=" " /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllMessages['sent']); ?>
                            <p class="card-category">Sent</p>
                            <h3 class="card-title"> <?= $overAllMessages['sent']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-lghter-blue" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllMessages['sent']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon ">
                            <div class="card-icon card-5">
                                <span><img src="<?php echo base_url() ?>public/assets/images/outbox.png" class="img-responsive" alt=" " /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllMessages['inbox']); ?>
                            <p class="card-category">inbox</p>
                            <h3 class="card-title"><?= $overAllMessages['inbox']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-light-blue" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllMessages['inbox']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon ">
                            <div class="card-icon card-6">
                                <span><img src="<?php echo base_url() ?>public/assets/images/wp.png" class="img-responsive" alt=" " /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllSocial['whatsapp']); ?>
                            <p class="card-category">Whatsapp</p>
                            <h3 class="card-title"><?= $overAllSocial['whatsapp']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-oragne" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllSocial['whatsapp']; ?> " aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon ">
                            <div class="card-icon card-7">
                                <span><img src="<?php echo base_url() ?>public/assets/images/fb.png" class="img-responsive" alt=" " /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllSocial['facebbox']); ?>
                            <p class="card-category">Facebook</p>
                            <h3 class="card-title"><?= $overAllSocial['facebbox']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-blue" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllSocial['facebbox']; ?> " aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon ">
                            <div class="card-icon card-8">
                                <span><img src="<?php echo base_url() ?>public/assets/images/gmail.png" class="img-responsive" alt="" /></span>
                            </div>
                            <?php $getCount = getProgressBarExcat($overAllSocial['gmail']); ?>
                            <p class="card-category">Gmail</p>
                            <h3 class="card-title"><?= $overAllSocial['gmail']; ?> of <?php echo $getCount['base_count']; ?>
                            </h3>
                        </div>
                        <div class="card-footer m-widget24">
                            <div class="m-widget24">                     
                                <div class="m-widget24__item">
                                    <div class="progress m-progress--sm">
                                        <div class="progress-bar m--bg-gmail" role="progressbar" style="width: <?php echo $getCount['per']; ?>%;" aria-valuenow="<?= $overAllSocial['gmail']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="circle-part section__content--p30">
            <div class="container-fluid">
                <div class="row">

                    <div class="col-md-4 col-sm-12 col-xs-12 ">
                        <div class="process-calls">
                            <h3 class="title-3 WEb_Browser">CALL</h3>
                            <div class="top">
                                <div class="percent-chart">
                                    <canvas id="percent-chart"></canvas>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue"></span>
                                        <span>incoming</span>
                                        <h5 style="color: #2bb1ea;"><?php echo $overAllCalls['incoming']; ?></h5>
                                    </div>
                                </div>
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue" style="background: #0afb5f;"></span>
                                        <span>Outgoing</span>
                                        <h5 style="color:#0afb5f;"><?php echo $overAllCalls['outgoing']; ?></h5>
                                    </div>
                                </div>
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue"  style="background: #e1465c;"></span>
                                        <span>Misscall</span>
                                        <h5 style="color:#e1465c;"><?php echo $overAllCalls['missedcall']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="process-calls">
                            <h3 class="title-3 WEb_Browser">MESSAGE</h3>
                            <div class="top">
                                <div class="percent-chart">
                                    <canvas id="percent-chart1"></canvas>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue" style="background: #f77118;"></span>
                                        <span>Sent</span>
                                        <h5 style="color: #f77118;"><?php echo $overAllMessages['sent']; ?></h5>
                                    </div>
                                </div>
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue" style="background: #22dbf8;"></span>
                                        <span>Inbox</span>
                                        <h5 style="color:#22dbf8;"><?php echo $overAllMessages['inbox']; ?></h5>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="process-calls">
                            <h3 class="title-3 WEb_Browser">SOCIAL MEDIA</h3>
                            <div class="top">
                                <div class="percent-chart">
                                    <canvas id="percent-chart2"></canvas>
                                </div>
                            </div>
                            <div class="bottom">
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue" style="background: #1a5ffb;"></span>
                                        <span>Facebook</span>
                                        <h5 style="color: #1a5ffb;"> <?php echo $overAllSocial['facebbox']; ?></h5>
                                    </div>
                                </div>
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue" style="background: #ff4949;"></span>
                                        <span>Gmail</span>
                                        <h5 style="color:#ff4949;"><?php echo $overAllSocial['gmail']; ?></h5>
                                    </div>
                                </div>
                                <div class="chart-note-wrap">
                                    <div class="chart-note mr-0 d-block">
                                        <span class="dot dot--blue"  style="background: #3dff79;"></span>
                                        <span>Whatsapp</span>
                                        <h5 style="color:#3dff79;"><?php echo $overAllSocial['whatsapp']; ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--start of Wew browser part -->

        <div class="web-browser section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <!-- TASK PROGRESS-->
                        <div class="task-progress">
                            <h3 class="title-3 WEb_Browser">WEB BROWSER</h3>
                            <div class="au-skill-container">
                                <?php
                                    $array = ['Crome','Firefox','Safari'];
                                    for($i=0; $i<count($getBrowserDetail); $i++) {
                                        $getCount = getProgressBarExcat($getBrowserDetail[$i]->totalCount);
                                ?>
                                <div class="au-progress">
                                    <span class="au-progress__title"><?php echo $getBrowserDetail[$i]->title; ?></span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple <?= $array[$i]; ?>" role="progressbar" data-transitiongoal="90" aria-valuenow="<?= $getBrowserDetail[$i]->totalCount; ?>" style="width: <?php echo $getCount['per']; ?>%;">
                                            
                                        </div>
                                        <span class="au-progress__value js-value"><?php echo $getCount['per']; ?>%</span>
                                    </div>
                                </div>
                                <?php } ?>
<!--                                <div class="au-progress">
                                    <span class="au-progress__title">Firefox</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple Firefox" role="progressbar" data-transitiongoal="85" aria-valuenow="85" style="width: 85%;">
                                            <span class="au-progress__value js-value">85%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="au-progress">
                                    <span class="au-progress__title">Safari</span>
                                    <div class="au-progress__bar">
                                        <div class="au-progress__inner js-progressbar-simple Safari" role="progressbar" data-transitiongoal="95" aria-valuenow="95" style="width: 95%;">
                                            <span class="au-progress__value js-value">95%</span>
                                        </div>
                                    </div>
                                </div>-->

                            </div>
                        </div>
                        <!-- END TASK PROGRESS-->
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <!-- TASK PROGRESS-->
                        <div class="task-progress">
                            <h3 class="title-3 WEb_Browser">GEO LOCATION</h3>
                            <div class="geo-container">
                                <div style="width: 100%"><iframe width="100%" height="360" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=23.0746617,72.52638689999999&amp;q=MARY%20ROE%20%20%20%20MEGASYSTEMS%20INC%20%20%20%20799%20E%20DRAGRAM%20SUITE%205A%20%20%20%20TUCSON%20AZ%2085705%20%20%20%20USA+(Mobile%20Monitoring)&amp;ie=UTF8&amp;t=&amp;z=14&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Embed Google Map</a></iframe></div><br />
                            </div>
                        </div>
                        <!-- END TASK PROGRESS-->
                    </div>
                </div>
            </div>
        </div>
        <!--End of Wew browser part -->

        <!--start of top 10 social media user part -->

        <div class="top_social section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $classArray = ['sky-light','sky-green','blue-light','blue-dark','dark-green','pink','dark-blue','light-green','danger-green','danger-blue'];
                    ?>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <!-- TASK PROGRESS-->
                        <div class="task-progress">
                            <h3 class="title-3 WEb_Browser">Top 10 social media Users</h3>
                            <?php 
                            
                                for($i=0; $i< count($topSocialUser); $i++) { 
                                    $getCount = getProgressBarExcat($topSocialUser[$i]->topSocialUser);
                                ?>
                            <div class="au-skill-container">
                                <div class="col-md-1">
                                    <div class="left-part-name">
                                        <span class="au-progress__title"><a href="<?php echo affiliate_url().'user/overview/'.$this->utility->encode($topSocialUser[$i]->user_id);?>" target="_blank"><?= $topSocialUser[$i]->user_name; ?></a></span>
                                    </div>
                                </div>
                                <div class="col-md-10">
                                    <div class="right-part">
                                        <div class="au-progress">
                                            <div class="au-progress__bar">
                                                <div class="au-progress__inner js-progressbar-simple <?= $classArray[$i]; ?>" role="progressbar" data-transitiongoal="90" 
                                                     aria-valuenow="<?= $topSocialUser[$i]->topSocialUser; ?>" style="width: <?php echo $getCount['per']; ?>%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-1">
                                    <div class="right-part-name">
                                        <span class="top-right-text"><?php echo $getCount['per']; ?>%</span>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of  top 10 social media user part -->
    </div>

    <script type="text/javascript">

        // Percent Chart

        var ctx = document.getElementById("percent-chart");
        if (ctx) {
            ctx.height = 280;
            var myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    datasets: [
                        {
                            label: "My First dataset",
                            data: ['<?php echo $overAllCalls['incoming']; ?>', '<?php echo $overAllCalls['outgoing']; ?>', '<?php echo $overAllCalls['missedcall']; ?>'],
                            backgroundColor: [
                                '#2bb1ea',
                                '#0afb5f',
                                '#e1465c',
                            ],
                            hoverBackgroundColor: [
                                '#2bb1ea',
                                '#0afb5f',
                                '#e1465c',
                            ],
                            borderWidth: [
                                0, 0, 0
                            ],
                            hoverBorderColor: [
                                'transparent',
                                'transparent',
                                'transparent'
                            ]
                        }
                    ],
                    labels: [
                        'Incoming',
                        'Outgoing',
                        'Misscall'
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutoutPercentage: 55,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleFontFamily: "Poppins",
                        xPadding: 15,
                        yPadding: 10,
                        caretPadding: 0,
                        bodyFontSize: 16
                    }
                }
            });
        }

        var ctx1 = document.getElementById("percent-chart1");
        if (ctx1) {
            ctx1.height = 280;
            var myChart = new Chart(ctx1, {
                type: 'doughnut',
                data: {
                    datasets: [
                        {
                            label: "My First dataset",
                            data: ['<?php echo $overAllMessages['inbox']; ?>', '<?php echo $overAllMessages['sent']; ?>'],
                            backgroundColor: [
                                '#22dbf8',
                                '#f77118'

                            ],
                            hoverBackgroundColor: [
                                '#22dbf8',
                                '#f77118'

                            ],
                            borderWidth: [
                                0, 0, 0
                            ],
                            hoverBorderColor: [
                                'transparent',
                                'transparent'

                            ]
                        }
                    ],
                    labels: [
                        'Inbox',
                        'Sent'

                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutoutPercentage: 55,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleFontFamily: "Poppins",
                        xPadding: 15,
                        yPadding: 10,
                        caretPadding: 0,
                        bodyFontSize: 16
                    }
                }
            });
        }


        var ctx2 = document.getElementById("percent-chart2");
        if (ctx2) {
            ctx2.height = 280;
            var myChart = new Chart(ctx2, {
                type: 'doughnut',
                data: {
                    datasets: [
                        {
                            label: "My First dataset",
                            data: ['<?php echo $overAllSocial['facebbox']; ?>', '<?php echo $overAllSocial['gmail']; ?>', '<?php echo $overAllSocial['whatsapp']; ?>'],
                            backgroundColor: [
                                '#1a5ffb',
                                '#ff4949',
                                '#3dff79',
                            ],
                            hoverBackgroundColor: [
                                '#1a5ffb',
                                '#ff4949',
                                '#3dff79',
                            ],
                            borderWidth: [
                                0, 0, 0
                            ],
                            hoverBorderColor: [
                                'transparent',
                                'transparent',
                                'transparent'
                            ]
                        }
                    ],
                    labels: [
                        'Facebook',
                        'Gmail',
                        'Whatsapp'
                    ]
                },
                options: {
                    maintainAspectRatio: false,
                    responsive: true,
                    cutoutPercentage: 55,
                    animation: {
                        animateScale: true,
                        animateRotate: true
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleFontFamily: "Poppins",
                        xPadding: 15,
                        yPadding: 10,
                        caretPadding: 0,
                        bodyFontSize: 16
                    }
                }
            });
        }
    </script>