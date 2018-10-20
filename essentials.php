<?php

class essentials
{
    public function debug($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

    public function dd($var)
    {
        debug($var);
        die();
    }

    public function convertDB($date)
    {
        $rep = str_replace('/', '-', $date);
        return date("Y-m-d", strtotime($rep));
    }

    public function convertView($date)
    {
        $rep = str_replace('-', '/', $date);
        return date("d/m/Y", strtotime($rep));
    }

}