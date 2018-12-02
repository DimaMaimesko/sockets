@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
        {{--<prop-component :urldata="{{json_encode($urlData)}}"></prop-component>--}}
        {{--<json-component></json-component>--}}
        {{--<line-chart-component></line-chart-component>--}}
        {{--<random-chart-component></random-chart-component>--}}
        {{--<socket-component></socket-component>--}}

    </div>
</div>
@endsection
<script>

</script>
