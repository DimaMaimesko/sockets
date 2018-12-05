<?php

namespace App\Http\Controllers;

use App\Room;
use App\User;
use Illuminate\Http\Request;
use App\Events\MessageSent;
use Illuminate\Support\Facades\Auth;
use App\Events\PrivateMessageSent;
use App\Events\EchoMessage;
use App\Events\PrivateEchoMessage;
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

    public function showChart()
    {
        return view('chat');
    }

    public function sendMessage(Request $request)
    {
        $message = $request->get('message');
        event(new MessageSent($message));
        return $message;
    }

    public function showPrivateChat()
    {
        $users = User::where('id', '!=', Auth::id())->get()->toArray();
        return view('private-chat', [
            'users' => $users,
            'userId' => Auth::id(),
        ]);
    }

    public function sendPrivateMessage(Request $request)
    {
       //PrivateMessageSent::dispatch($request->all());
//       dump($request->all());
        event(new PrivateMessageSent($request->get('message'), $request->get('channels')));
        return ['message' => $request->get('message'), 'channels' => $request->get('channels')];
    }

    public function showEchoChat()
    {
        return view('echo-chat');
    }

    public function sendEchoMessage(Request $request)
    {
       EchoMessage::dispatch($request->input('body'));
    }


    public function privateRoom($room)
    {
        $room = Room::where('id', $room)->with('users')->first();
        return view('private-echo-chat', [
            'room' => $room,
        ]);
    }

    public function sendPrivateEchoMessage(Request $request)
    {
        PrivateEchoMessage::dispatch($request->get('message'), $request->get('room_id'));
        return [$request->get('message'), $request->get('room_id')];
    }

}
