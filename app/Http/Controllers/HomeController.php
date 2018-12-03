<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        session(['result' => null]);
        $urlData = [
            array(
                'title' => 'DKA-DEVELOP',
                'url' => 'https://dka-develop.ru'
            ),
            array(
                'title' => 'Youtube',
                'url' => 'https://youtube.com'
            ),
        ];
        return view('home', [
            'urlData' => $urlData,
        ]);
    }

    public function getJson()
    {
       return [
            array(
                'title' => 'DKA-DEVELOP',
                'url' => 'https://dka-develop.ru'
            ),
            array(
                'title' => 'Youtube',
                'url' => 'https://youtube.com'
            ),
        ];

    }


    public function chartData()
    {
       return [
                'labels' => ['marth', 'april', 'may', 'june', 'july'],
                'datasets' => array([
                    'label' => 'Продажи',
                    'backgroundColor' => '#F26202',
                    'data' => [1432,122,3433,3245,645],
                ])
        ];
    }

    public function chartRandom()
    {
        return [
            'labels' => ['marth', 'april', 'may', 'june', 'july'],
            'datasets' => array(
                [
                'label' => 'Золото',
                'backgroundColor' => '#003245',
                'data' => [rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000)],
                ],
                [
                'label' => 'Серебро',
                'backgroundColor' => '#F74345',
                'data' => [rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000),rand(0, 40000)],
                ],

            )
        ];

    }

    public function newEvent(Request $request)
    {
        if(!session('result')){
            $result = [
                'labels' => ['marth', 'april', 'may', 'june', 'july'],
                'datasets' => array([
                    'label' => 'дажи',
                    'backgroundColor' => '#F26202',
                    'data' => [1432,122,3433,3245,645],
                ])
            ];
        }else{
            $result = session('result');
        }

        if ($request->has('label')){
            $result['labels'][] = $request->input('label');
        };
        if ($request->has('sale')){
            $result['datasets'][0]['data'][] = (integer)$request->input('sale');
        };
        if ($request->has('realtime')){
           if (filter_var($request->input('realtime'), FILTER_VALIDATE_BOOLEAN)){
               event(new \App\Events\NewEvent($result));
           }
        };


        session(['result' => $result]);

        return $result;



    }

}
