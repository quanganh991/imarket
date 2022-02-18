<?php
namespace App\Http\Controllers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EvaluateController extends Controller
{
    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    //    static function evaluate(Collection $news){
    static function evaluate(Collection $news){

        if (Session::get('id_user')) {

            $url = "http://192.168.0.107:8000/evaluate";
            $client = new Client();
            $id_news = [];
            $id_user = Session::get('id_user');

            foreach($news as $each_new){
                array_push($id_news,$each_new->id_news);
            }

            $response = $client->request('GET', $url, ['query' => [
                'id_news' => $id_news,
                'id_user' => $id_user
            ]])->getBody();

            $response = json_decode((string)$response, true);
            //lấy các id_news từ response
            $all_response_id_news = [];
            $all_id_news_and_its_scores = $response[0];
            foreach($all_id_news_and_its_scores as $key => $each_id_news_and_its_score){
                array_push($all_response_id_news,$key);
            }

            $news_after_sorted = new Collection();

            for($i = 0;$i<count($all_response_id_news);$i++){
                for($j=0;$j<count($news);$j++){
                    if((int)$news[$j]->id_news == $all_response_id_news[$i]){
                        $news_after_sorted->push($news[$j]);
                        break;
                    }
                }
            }

            return $news_after_sorted;
        } else {
            return $news;
        }
    }

    static function retrain(){
        $url = "http://192.168.0.107:8000/retrain";
        $client = new Client();

        $response = $client->request('GET', $url)->getBody();

        return json_decode((string)$response, true);
    }
}



//Nhận:
//$url = 'http://192.168.0.107:8000/evaluate';
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, Array("User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/20080623 Firefox/2.0.0.15"));
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//        $result = curl_exec($ch);
//        curl_close($ch);
//        $info = json_decode($result, true);
//        for ($i = 1; $i <= 4; $i++) {
//            foreach ($info[$i] as $key => $value) {
//                print_r($value . "\t" . " ");
//            }
//            echo '<br>';
//        }


//Gửi:
//$endpoint = "http://192.168.0.107:8000/evaluate";
//        $client = new Client();
//        $id = 5;
//        $value = "ABC";
//
//        $response = $client->request('GET', $endpoint, ['query' => [
//            'key1' => $id,
//            'key2' => $value,
//        ]]);
//
//        $statusCode = $response->getStatusCode();
//        $content = json_decode($response->getBody(), true);
//        return [$content, $statusCode];
