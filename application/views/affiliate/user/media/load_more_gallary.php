<?php
if (!empty($gallaryData)) {
    for ($i = 0; $i < count($gallaryData); $i++) {
        $img = explode('.', $gallaryData[$i]->image);
        ?>
        <div class="lightbox">

            <figure class="effect-goliath">
                <img src="<?php echo base_url() . 'public/upload/gallary/' . $img[0] . '_thumb.' . $img[1]; ?>" alt="img23"/>
                <figcaption>
                    <p>
                        <a href="#">Download</a> 
                        <a href="<?php echo base_url() . 'public/upload/gallary/' . $gallaryData[$i]->image; ?>">View Large</a>
                    </p>
                </figcaption>			
            </figure>
        </div>
    <?php }
} ?>