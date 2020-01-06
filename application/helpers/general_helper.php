<?php

function admin_url($url = '')
{
    $CI = &get_instance();
    return $CI->config->config['admin_url'] . $url;
}

function affiliate_url($url = '')
{
    $CI = &get_instance();
    return $CI->config->config['affiliate_url'] . $url;
}

function get_project_name()
{
    $CI = &get_instance();
    return $CI->config->config['project_name'];
}

function get_skip($page_no = 1, $per_page = 24)
{
    return (($page_no - 1) * $per_page);
}

function upload_single_image($file, $name, $path, $thumb = FALSE)
{
    $CI = &get_instance();

    $return['error'] = '';
    $image_name = $name . '_' . time();

    $CI->load->helper('form');
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'gif|jpg|png|jpeg|JPEG|PNG|JPG';
    $config['file_name'] = $image_name;

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    $CI->upload->set_allowed_types('gif|jpg|png|jpeg|JPEG|PNG|JPG|GIF');

    if (!$CI->upload->do_upload(key($file))) {
        $return['error'] = $CI->upload->display_errors();
    } else {
        $result = $CI->upload->data();
        $return['data'] = $result;
    }

    if ($thumb == TRUE && $return['error'] == '') {
        
        $CI->load->library('image_lib');
        $conf['image_library'] = 'gd2';
        $conf['source_image'] = $path . $result['orig_name'];
        $conf['create_thumb'] = TRUE;
        $conf['maintain_ratio'] = TRUE;
        $conf['new_image'] = $result['orig_name'];
        $conf['thumb_marker'] = '_thumb';
        $conf['width'] = '226';
        $conf['height'] = '170';
        $CI->image_lib->clear();
        $CI->image_lib->initialize($conf);
        if (!$CI->image_lib->resize()) {
            $return['error'] = 'Thumb Not Created';
        }
        
    }

    return $return;
}

function upload_video($file, $name, $path, $thumb = FALSE)
{
    
    ini_set( 'memory_limit', '500M' );
    ini_set('upload_max_filesize', '500M');  
    ini_set('post_max_size', '500M');  
    ini_set('max_input_time', 3600);  
    ini_set('max_execution_time', 3600);
    
    $CI = &get_instance();

    $return['error'] = '';
    $video_name = $name . '_' . time();

    $CI->load->helper('form');
    $config['upload_path'] = $path;
    $config['allowed_types'] = 'mp4';
    $config['max_size'] = '1000000';
    $config['file_name'] = $video_name;
    $config['max_width']  = '1024000';
    $config['max_height']  = '768000';

    $CI->load->library('upload', $config);
    $CI->upload->initialize($config);

    $CI->upload->set_allowed_types('mp4');

    if (!$CI->upload->do_upload(key($file))) {
        $return['error'] = $CI->upload->display_errors();
    } else {
        $result = $CI->upload->data();
        $return['data'] = $result;
    }

    if ($thumb == TRUE && $return['error'] == '') {
        
        $CI->load->library('image_lib');
        $conf['image_library'] = 'gd2';
        $conf['source_image'] = $path . $result['orig_name'];
        $conf['create_thumb'] = TRUE;
        $conf['maintain_ratio'] = TRUE;
        $conf['new_image'] = $result['orig_name'];
        $conf['thumb_marker'] = '_thumb';
        $conf['width'] = '226';
        $conf['height'] = '170';
        $CI->image_lib->clear();
        $CI->image_lib->initialize($conf);
        if (!$CI->image_lib->resize()) {
            $return['error'] = 'Thumb Not Created';
        }
        
    }

    return $return;
}


function data() {
    if ($_SERVER['CONTENT_TYPE'] != 'application/json') {
        apiResponse();
    }
    $data = json_decode(file_get_contents('php://input'), true);
    return $data;
}

function getUserName ($userId){
    $CI = &get_instance();
    
    $result = $CI->db->get_where('user',array('id' => $userId))->result_array();
    return $result[0]['user_name'];
}


function getProgressBarExcat($value){
    
    $array = [100,200,300,400,500,600,700,800,900,1000,1100,1200,1300,1400,1500];
    $baseCount = '';
    for($i=0; $i<count($array); $i++){
        if($value < $array[$i]){
            $baseCount = $array[$i];
            break;
        }
    }
    
    $finalPercentage = (100 * $value) / $baseCount;
    
    $data_array = array(
        'per' => $finalPercentage,
        'base_count' => $baseCount,
    );
    
    return $data_array;
    
}