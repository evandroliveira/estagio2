<?php

class essentials
{
    public function dd($val)
    {
        echo '<pre>';
        print_r($val);
        echo '</pre>';
        die();
    }

    public function convertDB($date)
    {
        $rep = str_replace('/', '-', $date);
        return date("Y-m-d", strtotime($rep));
    }


}