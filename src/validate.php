<?php

namespace {

    if (!defined('HTTP_URL_REPLACE')) {
        define('HTTP_URL_REPLACE', 1);
    }

    if (!function_exists('http_build_url')) {
        function http_build_url($url, $parts = null, $flags = HTTP_URL_REPLACE, array &$new_url = [])
        {
            $return = '';

            if (is_array($url)) {
                if (isset($url['scheme'])) {
                    $return .= $url['scheme'] . '://';
                }

                if (isset($url['host'])) {
                    $return .= $url['host'];
                }

                if (isset($url['port'])) {
                    $return .= ':' . $url['port'];
                }

                if (isset($url['path'])) {
                    $return .= $url['path'];
                }

                if (isset($url['query'])) {
                    $return .= '?' . $url['query'];
                }

                if (isset($url['fragment'])) {
                    $return .= '#' . $url['fragment'];
                }
            }

            return $return;
        }
    }
}

namespace ValidateRapper {

    if (!function_exists('validate_url')) {

        function validate_url($variable, $options = null)
        {
            $parsed_url = parse_url($variable);
            if (empty($parsed_url) || !is_array($parsed_url) || empty($parsed_url['host'])) {
                return false;
            }

            $parsed_url['host'] = idn_to_ascii($parsed_url['host']);

            return (bool) filter_var(http_build_url($parsed_url), FILTER_VALIDATE_URL, $options);
        }

        function validate_email($variable, $options = null)
        {
            if (($pos = strrpos($variable, '@')) === false) {
                return false;
            }

            $local_part  = substr($variable, 0, $pos);
            $domain_part = substr($variable, $pos + 1);

            return (bool) filter_var($local_part . '@' . idn_to_ascii($domain_part), FILTER_VALIDATE_EMAIL, $options);
        }
    }

}