{!! Form::open(['url' => 'foo/bar']) !!}
    {{Form::token()}}
    {{Form::label('email', 'E-Mail Address', ['class' => 'awesome'])}}
    {{Form::text('email', 'example@gmail.com')}}
{!! Form::close() !!}
