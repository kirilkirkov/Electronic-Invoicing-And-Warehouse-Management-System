<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Convert html of invoice to pdf
 * Use wkhtmltopdf tool - http://wkhtmltopdf.org/
 */

class HtmlToPdf
{

    public function generatePdf(
    $html, $left_right = null, $top_bot = null, $dpi = null, $size = null, $extra_params = null
    )
    {
        if ($left_right === null) {
            $left_right = 4;
        }
        if ($top_bot === null) {
            $top_bot = 10;
        }
        if ($dpi === null) {
            $dpi = 96;
        }
        if ($size === null) {
            $size = 'A4';
        }

        $sys_tmp_dir = sys_get_temp_dir();

        $tmpfile = tempnam($sys_tmp_dir, 'pdf_html');

        if ($tmpfile === false) {
            echo "Was not able to generate a temporary file";
        }

        $tmphtml = $tmpfile . '.html';

        $protocol = 'http';
        if (!empty($_SERVER['HTTPS'])) {
            $protocol = 'https';
        }

        if (false === file_put_contents($tmphtml, $html)) {
            echo "Was not able to create HTML file " . $tmphtml;
        }
        $tmpfname = tempnam($sys_tmp_dir, 'html_pdf');

        if ($tmpfname === false) {
            echo "Was not able to generate a temporary file";
        }

        $cmd = 'xvfb-run wkhtmltopdf --load-error-handling ignore' .
                ' --no-stop-slow-scripts' .
                ' -q ' . $extra_params .
                ' -d ' . $dpi .
                ' -s ' . $size .
                ' -L ' . intval($left_right) . 'mm' .
                ' -R ' . intval($left_right) . 'mm' .
                ' -T ' . intval($top_bot) . 'mm' .
                ' -B ' . intval($top_bot) . 'mm' .
                ' ' . escapeshellarg($tmphtml) .
                ' ' . escapeshellarg($tmpfname) .
                ' &>> ' . escapeshellarg('pdfs.log');

        exec($cmd, $output, $exit_status);
        /*
         * If when call var_dump(file_get_contents($tmpfname)); returns null
         * its possible to have error with xvfb
         * https://unix.stackexchange.com/questions/192642/wkhtmltopdf-qxcbconnection-could-not-connect-to-display
         */
        if (is_file($tmphtml)) {
            unlink($tmphtml);
        }

        if ($exit_status !== 0) {
            if (is_file($tmpfname)) {
                unlink($tmpfname);
            }
            if (is_file($tmpfile)) {
                unlink($tmpfile);
            }
            echo "Generating PDF failed. See logs for more information.";
        }

        $pdfcontents = file_get_contents($tmpfname);

        if (is_file($tmpfname)) {
            unlink($tmpfname);
        }

        if (is_file($tmpfile)) {
            unlink($tmpfile);
        }

        if ($pdfcontents === false) {
            echo "Couldn't read the PDF file.";
        }

        return $pdfcontents;
    }

}
