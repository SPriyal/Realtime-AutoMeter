<html>

<head>
<script src="{{ asset ("/bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>
</head>
<body>
{!! Form::open(['url' => 'home', 'method' => 'get']) !!}
    {!! Form::text('name', null, ['id'=>'users']) !!}
    {!! Form::submit('GO') !!}
{!! Form::close() !!}


<script src="/js/TypeAhead/typeahead.bundle.js"></script>
<script src="/js/TypeAhead/taMain.js"></script>
{{--<script src="{{ asset ("/js/TypeAhead/TypeAheadMain.js") }}></script>--}}
</body>

</html>

