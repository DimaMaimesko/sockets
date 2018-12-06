@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Echo Chat</h2>
    <div class="row justify-content-center">
            @if (Auth::check())
                <h3>Wellcome <strong>{{Auth::user()->name}}</strong></h3>
                <private-echo-chat-component :room="{{json_encode($room)}}" :user="{{Auth::user()}}"></private-echo-chat-component>
            @endif
    </div>
</div>
@endsection

