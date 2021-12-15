<?php

namespace App\Http\Controllers\BuyerController;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request, Illuminate\Support\Facades\Session, Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function all_product(){

        $url = 'http://192.168.0.107:8000/';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15"));
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        $info = json_decode($result, true);
        for ($i = 1; $i <= 4; $i++) {
            foreach ($info[$i] as $key => $value) {
                    print_r($value . "\t" . " ");
            }
            echo '<br>';
        }
    }
}
