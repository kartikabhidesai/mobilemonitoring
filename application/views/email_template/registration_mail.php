<div style="width: 560px; margin: 0 auto; display: block; box-shadow: 0px 0px 14px 0px rgba(142, 140, 140, 0.67); background: #fff; padding: 48px;padding-top: 5px;">
    <!-- wrapper -->
    <p style=""><img src="<?php echo base_url().'public/assets/images/mm_mail_logo.png'; ?>" style="display: block;margin: 0 auto; text-align: center; width: 200px;padding: 10px;"></p>
    <h2 style="padding-bottom: 30px;text-align: center; display: block;font-family: sans-serif; margin:0 auto;">EMAIL VERIFICATION</h2>
    <div style="background: linear-gradient(#fff,rgba(255, 66, 0, 0.16));
         box-shadow: 0px 0px 16px 0px rgba(0, 0, 0, 0.33);
         padding: 16px;">
        <!-- Contnt start -->
        <h3 style="margin-top: 10px;font-family: sans-serif;">Dear <b><?php echo $username; ?></b>, </h3>
        <!-- <h3 style="margin-top: 30px;">Hello ,</h3> -->
        <p style ="font-size:16px; font-family: sans-serif; margin-top:30px;line-height: 24px;">You have successfully created account with <?php echo PROJECT_NAME; ?></p>

        <p style ="font-size:16px;font-family: sans-serif;line-height: 24px;">please verify your email address with us using below link</p>

        <p style="font-size:16px; margin-top:40px;line-height: 24px;font-family: sans-serif;">
            <a href="<?php echo $link; ?>" style="padding: 10px 29px; border: 1px solid #ff4200;text-decoration: none;color: #fff; background: #ff4200; float: left;box-shadow: 2px 3px 5px 0px #7a7676;">VERIFY EMAIL</a></p>

        <br>

        <p style="font-size:16px; margin-top:60px; font-family: sans-serif; line-height: 24px;">Thank You,</p>
        <p style="font-size:16px; margin-top:0px;font-family: sans-serif; line-height: 24px;">Team <?php echo PROJECT_NAME; ?></p>

    </div>
    <!-- content over -->
</div>