<?php
/**
 * Created by PhpStorm.
 * User: Ashish-pc
 * Date: 7/20/2017
 * Time: 4:18 PM
 */
function finddevice() {
    $useragent = $_SERVER['HTTP_USER_AGENT'];

    if (preg_match('/(android|bb\d+|meego).+'
            . 'mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|'
            . 'ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?'
            . '|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.'
            . '(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) ) {
        $type = 'mobile';
    } else {
        $type = 'web';
    }
    
    return $type;
}