<?php

function show_image($filename='', $image_type = '', $tenant_id=1, $type = 'a', $width = 1, $height = 1) {
    $image = \Config\Services::image();

    $cell_unit = 150;
    $image_file = explode('.',$filename);
    $cached_filename = $image_file[0] .'_'. $image_type .'_'. $tenant_id .'_'. $type .'_'. $width .'_'. $height .'.'. $image_file[1];

    if(file_exists('../public/uploads/cached/'. $cached_filename)) {
        return base_url() . '/uploads/cached/'. $cached_filename;
    } else {
        if(file_exists('../public/uploads/images/'. $tenant_id .'/'. $image_type .'/'. $filename) == true) {
            if($type == 'a') { // absolute resolution
                $w = $width;
                $h = $height;
            } else if($type == 'r') { // ratio resolution
                $w = $width * $cell_unit;
                $h = $height * $cell_unit;
            }
            $image
            ->withFile('../public/uploads/images/'. $tenant_id .'/'. $image_type .'/'. $filename)
            ->resize($w, $h, true)
            ->save('../public/uploads/cached/'. $cached_filename, 65);
            return base_url() . '/uploads/cached/'. $cached_filename;

        } else {
            if($type == 'a') { // absolute resolution
                $w = $width;
                $h = $height;
            } else if($type == 'r') { // ratio resolution
                $w = $width * $cell_unit;
                $h = $height * $cell_unit;
            }
            $image
            ->withFile('../public/img/noimage.png')
            ->resize($w, $h, true)
            ->save('../public/uploads/cached/noimage_'.$w.'_'.$h.'.png');
            return base_url() .'/uploads/cached/noimage_'.$w.'_'.$h.'.png';
        }
    }

}
?>