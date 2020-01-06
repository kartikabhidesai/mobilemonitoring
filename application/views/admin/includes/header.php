<head>
    <meta charset="utf-8"/>
    <?php
    $title = empty($var_meta_title) ? get_project_name() : $var_meta_title . ' | ' . get_project_name();
    $description = empty($var_meta_description) ? get_project_name() : $var_meta_description . ' | ' . get_project_name();
    $keywords = empty($var_meta_keyword) ? get_project_name() : $var_meta_keyword . ' | ' . get_project_name();
    ?>
    <title><?= $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="<?= $description; ?>" name="description" />
    <meta content="<?= $keywords; ?>" name="author" />

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="<?= base_url(); ?>public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    
    <link href="<?= base_url(); ?>public/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>
    
    

    <link href="<?= base_url(); ?>public/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css"/>

    <!-- BEGIN THEME GLOBAL STYLES -->
    <link href="<?= base_url(); ?>public/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <!-- END THEME GLOBAL STYLES -->
    <!-- BEGIN THEME LAYOUT STYLES -->
    <link href="<?= base_url(); ?>public/assets/layouts/layout/css/layout.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/layouts/layout/css/themes/darkblue.min.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?= base_url(); ?>public/assets/layouts/layout/css/themes/darkgreen.min.css" rel="stylesheet" type="text/css" id="style_color"/>
    <link href="<?= base_url(); ?>public/assets/layouts/layout/css/custom.css" rel="stylesheet" type="text/css"/>
    
    <!-- END THEME LAYOUT STYLES -->
    
    <?php
    if (!empty($css)) {
        foreach ($css as $value) { ?>
            <link rel="stylesheet" href="<?= base_url(); ?>public/assets/css/<?php echo $value; ?>"/>
            <?php
        }
    }
    ?>
    <?php
    if (!empty($css_plugin)) {
        foreach ($css_plugin as $value_plugin) {
            ?>
            <link rel="stylesheet" href="<?= base_url(); ?>public/assets/global/plugins/<?php echo $value_plugin; ?>"/>
            <?php
        }
    }
    ?>
    <link href="<?= base_url(); ?>public/assets/global/css/custom.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="<?= DISPLAY_ICO ?>"/>
    <style>
        .modal-open .colorpicker, .modal-open .datepicker, .modal-open .daterangepicker{
            z-index: 999999999!important;
        }
    </style>
    <script type="text/javascript">
        var baseurl = "<?php echo base_url(); ?>";
        var adminurl = "<?php echo admin_url(); ?>";
    </script>
    <script src="<?= base_url(); ?>public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
    
    <?php if (isset($geoLocation)) { ?>
        <script src="http://maps.googleapis.com/maps/api/js?libraries=places,geometry&key=AIzaSyAbaTTWnkEvs_H4uKBDv_-OLN_wMYxjx0M" type="text/javascript"></script>
    <?php } ?>
</head>
