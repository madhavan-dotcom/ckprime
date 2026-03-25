<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use BaconQrCode\Renderer\Image\Png;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Common\ErrorCorrectionLevel;

class QRcode extends CI_Controller {

    public function index()
    {
        // Load the view for generating the QR code
        $this->load->view('generate_qr_code');
    }

    public function generate_qr_code()
    {
        // Load the PHP QR Code library
        require APPPATH . 'vendor/autoload.php';

        // Example signed invoice data (replace this with your generated signed invoice)
        $signedInvoice = 'Your generated signed invoice data here';

        // Create a QR code writer
        $renderer = new ImageRenderer(
            new RendererStyle(400),
            new Png(),
            new ErrorCorrectionLevel(ErrorCorrectionLevel::HIGH)
        );
        $writer = new Writer($renderer);

        // Generate the QR code image as binary data
        $qrCodeData = $writer->writeString($signedInvoice);

        // Output the QR code image directly to the browser
        header('Content-Type: image/png');
        echo $qrCodeData;
    }
}
