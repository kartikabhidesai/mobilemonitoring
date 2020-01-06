<?php
if (!empty($videoData)) {
    for ($i = 0; $i < count($videoData); $i++) {
        ?>
        <figure class="effect-goliath">
            <video width="226" height="170" controls>
                <source src="<?php echo base_url() . 'public/upload/videos/' . $videoData[$i]->video; ?>" type="video/mp4">
            </video>
        </figure>
    <?php }
} ?>
