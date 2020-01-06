<!DOCTYPE html>

<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->

<head>
    <meta charset="utf-8"/>
    <title> Login | <?= get_project_name(); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    
    <link href="<?= base_url(); ?>public/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/css/components.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/pages/css/login.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= base_url(); ?>public/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="<?= DISPLAY_ICO ?>"/>
    
    <script>
        var baseurl = "<?php echo base_url(); ?>";
    </script>
</head>
<!-- END HEAD -->

<body class="login">
<div class="menu-toggler sidebar-toggler"></div>
<div class="logo">
    <a href="<?= base_url(); ?>">
        <img src="<?= base_url() .DISPLAY_LOGO; ?>" alt="<?= get_project_name(); ?>" width="150"/> </a>
</div>
<!-- END LOGO -->
<?php echo $this->load->view($page); ?>
<!-- BEGIN LOGIN -->

<div class="copyright"> <?= date('Y') . ' © ' . get_project_name(); ?>.</div>
<!--[if lt IE 9]>

<![endif]-->
<!-- BEGIN CORE PLUGINS -->
<script src="<?= base_url(); ?>public/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>public/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>public/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>public/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>

<?php
if (!empty($js_plugin)) {
    foreach ($js_plugin as $value) {
        ?>
        <script src="<?= base_url(); ?>public/assets/global/plugins/<?php echo $value ?>" type="text/javascript"></script>
        <?php
    }
}
?>

<script src="<?= base_url(); ?>public/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>public/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
<script src="<?= base_url(); ?>public/assets/global/scripts/app.js" type="text/javascript"></script>

<?php
if (!empty($js)) {
    foreach ($js as $value) {
        ?>
        <script src="<?php echo base_url(); ?>public/assets/javascripts/<?php echo $value ?>" type="text/javascript"></script>
        <?php
    }
}
?>

<script src="<?php echo base_url(); ?>public/assets/javascripts/common_function.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        <?php
        if (!empty($init)) {
            foreach ($init as $value) {
                echo $value . ';';
            }
        }
        ?>
    });
</script>
<script type="text/javascript">
    window.history.forward();
    function noBack() { window.history.forward(); }
</script>
</body>
</html>