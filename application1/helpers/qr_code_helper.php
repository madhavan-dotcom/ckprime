<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once(APPPATH . 'libraries/phpqrcode/qrlib.php');

function generate_qr_code($invoice_data)
{
    $path = 'path_to_store_qr_codes/'; // Replace with the actual path where you want to store QR codes

    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $file_name = 'invoice_qr_code_' . uniqid() . '.png';
    $file_path = $path . $file_name;

    QRcode::png($invoice_data, $file_path, QR_ECLEVEL_L, 10);

    return base_url() . $file_path;
}
