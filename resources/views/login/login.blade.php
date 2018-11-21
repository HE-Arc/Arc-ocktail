@extends('layouts.app')

@section('title')
    {{config('app.name', "Arc'ocktail")}}
@endsection

@section('content')
    <div class="row row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-6 border rounded p-3">
            <h1>Login</h1>
            {!! Form ::open(array('route' => 'handleLogin')) !!}
                <div class="form-group">
                    {!! Form::label('username') !!}
                    {!! Form::text('username', null, array('class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password') !!}
                    {!! Form::password('password', array('class' => 'form-control')) !!}
                </div>
                {!! Form::token() !!}
                {!! Form:: submit(null, array('class' => 'btn btn-success')) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection


@section('script')
@endsection
