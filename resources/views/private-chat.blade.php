@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            @if (Auth::check())
                <h3>Wellcome <strong>{{Auth::user()->name}}</strong></h3>
                <private-chat-component :users="{{json_encode($users)}}" :user-id='{{$userId}}'></private-chat-component>
            @endif
    </div>
</div>
@endsection

