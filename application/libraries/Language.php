<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This class loads languages for site
 * Its is not with very good code but.. for short time.. 
 * it works :)
 */

class Language
{

    protected $CI;
    private $urlAbbrevation;

    public function __construct()
    {
        $this->CI = & get_instance();
        $this->CI->load->model('PublicModel');
        $this->urlAbbrevation = strtolower($this->CI->uri->segment(1));
        $this->setLanguage();
    }

    private function setLanguage()
    {
        $defaultLanguageName = $language = $this->CI->config->item('language');
        $defaultLanguageAbbr = $myLanguage = strtolower($this->CI->config->item('language_abbr'));
        $currency = $this->CI->config->item('currency');
        $currencyKey = $this->CI->config->item('currencyKey');
        $langLinkStart = '';
        /*
         * If try to select default language, clean it and return to url
         * Else get the language
         */
        if ($this->urlAbbrevation == $defaultLanguageAbbr) {
            $currentUrl = str_replace($this->urlAbbrevation, '', uri_string());
            redirect(base_url($currentUrl));
        } else {
            $myLang = $this->CI->PublicModel->getOneLanguage($this->urlAbbrevation);
            if ($myLang != null) {
                $myLanguage = $myLang['abbr'];
                $language = $myLang['name'];
                $currency = $myLang['currency'];
                $currencyKey = $myLang['currencyKey'];
                $langLinkStart = $myLanguage . '/';
            }
        }
        $this->CI->lang->load('public', $language);
        $this->CI->lang->load('users', $language);
		$this->CI->lang->load('titles', $language);

        define('MY_LANGUAGE_FULL_NAME', $language);
        define('MY_LANGUAGE_ABBR', $myLanguage);
        define('MY_DEFAULT_LANGUAGE_ABBR', $defaultLanguageAbbr);
        define('MY_DEFAULT_LANGUAGE_NAME', $defaultLanguageName);
        define('CURRENCY', $currency);
        define('CURRENCY_KEY', $currencyKey);
        define('LANG_URL', rtrim(base_url($langLinkStart), '/'));
    }

    public function getUrlAbbrevation()
    {
        return $this->urlAbbrevation;
    }

}
