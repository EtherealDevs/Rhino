<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhapController extends Controller
{
    public function envio(){
        try{

            $token = 'EAAR7C5A7gxYBO6CaeaW2pZBFZC7ZABPbE2hPoXDCgBZA4UthPJVrBD258kYWTURHxgvCRQdDpOXOw4kgTdYZBAcEeguaZBOpe8bEylTgzNTeRryBbWY9MWYElwaRkZCrSCV5ZBW700vg4IFDRZCimF1HT8Pxo37mHpEZCk0Qu7taC9OIZCB53s1uX0GquKX7T9QaKXwlxjC7hcOJYXsABfTtHoZD';
            $phoneId = '250636368133465';
            $version ='v20.0';
            $payload = [
                'messaging_product' => 'whatsapp',
                "to"=> "543794011861",
                "type"=> "template",
                "template"=> [
                    "name"=> "prueba",
                    "language"=> [ "code"=> "en_US" ]
            ]];

            $url= 'https://graph.facebook.com/'.$version.'/'.$phoneId.'/messages';
            $message = Http::withToken($token)->post($url,$payload)->throw()->json();

            return response()->json([
                'success' => true,
                'data' => $message
            ],200);
        }
        catch (Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ],500);
        }
    }
}
