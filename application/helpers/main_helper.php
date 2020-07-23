<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('date_default'))
{
    function date_default()
    {
        return date('Y-m-d H:i:s', local_to_gmt(time()));
    }
}

if ( ! function_exists('date_gmtToLocal'))
{
    function date_gmtToLocal($time)
    {
        return date('Y-m-d H:i:s', gmt_to_local(strtotime($time),'UP8',FALSE));
    }
}

if ( ! function_exists('format_date_default'))
{
    function format_date_default($date)
    {
        return date('Y-m-d', strtotime($date.'+1 days'));
    }
}

if ( ! function_exists('validateDate'))
{
    function validateDate($date)
    {
        $test_date = $date;
        $test_arr  = explode('-', $test_date);
        if (count($test_arr) == 3) {
            if (checkdate($test_arr[1], $test_arr[2], $test_arr[0])) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
