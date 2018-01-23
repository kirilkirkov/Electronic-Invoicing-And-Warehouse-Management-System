<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Convert html of invoice to pdf
 * Use wkhtmltopdf tool - http://wkhtmltopdf.org/
 */

class HtmlToPdf
{

    private $num;
    private $type;

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
            log_message('error', 'Was not able to generate a temporary file for ' . $this->type . ' preview in system /tmp for user - ' . print_r($_SESSION['user_login'], true));
        }

        $tmphtml = $tmpfile . '.html';

        $protocol = 'http';
        if (!empty($_SERVER['HTTPS'])) {
            $protocol = 'https';
        }

        if (false === file_put_contents($tmphtml, $html)) {
            log_message('error', 'Was not able to put html to a temporary file for ' . $this->type . ' preview in system /tmp for user - ' . print_r($_SESSION['user_login'], true));
        }
        $tmpfname = tempnam($sys_tmp_dir, 'html_pdf');

        if ($tmpfname === false) {
            log_message('error', 'Was not able to generate a temporary file 2 for ' . $this->type . ' preview in system /tmp for user - ' . print_r($_SESSION['user_login'], true));
        }
		if(!file_exists('/home/kirilkirkov91/wkhtmltox/bin/wkhtmltopdf')) {
			log_message('error', 'Please choose directory of wkhtmltopdf bin file in next $cmd variable');
		}

        $footerUrl = base_url('pdffooter?num=' . $this->num . '&type=' . $this->type . '&pageTranslate=' . $this->pageTranslation);
        $cmd = '/home/kirilkirkov91/wkhtmltox/bin/wkhtmltopdf --footer-html "' . $footerUrl . '" --load-error-handling ignore --enable-local-file-access' .
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
         * It must run without call xvfb! Download source for os from - https://wkhtmltopdf.org/downloads.html
         * Extract to some folder and call the app
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
            log_message('error', 'Generating PDF failed. See logs for more information. Problem for user - ' . print_r($_SESSION['user_login'], true));
        }

        $pdfcontents = file_get_contents($tmpfname);

        if (is_file($tmpfname)) {
            unlink($tmpfname);
        }

        if (is_file($tmpfile)) {
            unlink($tmpfile);
        }

        if ($pdfcontents === false) {
            log_message('error', 'Couldn\'t read the PDF file for user - ' . print_r($_SESSION['user_login'], true));
        }

        return $pdfcontents;
    }

    public function setNum($num)
    {
        $this->num = $num;
    }

    public function setType($type)
    {
        $this->type = urlencode($type);
    }

    public function setPageTranslate($translation)
    {
        $this->pageTranslation = urlencode($translation);
    }

}
