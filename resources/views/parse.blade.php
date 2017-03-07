@extends ('base')

@section ('content')
    @if (isset($result['error']))
        <div class="row">
            <div class="col-md-12 alert alert-danger">
                Error: {{ $result['error'] }}
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 alert alert-info">
            <h4>Executed code:</h4>
            <ol>
                @foreach ($result['commands'] as $index => $command)
                    @if (isset($result['error_line']) && $result['error_line'] - 1 == $index)
                        <li class="bg-danger"> {{ $command }} </li>
                    @else
                        <li> {{ $command }} </li>
                    @endif
                @endforeach
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 alert alert-success">
            <h4>Output:</h4>
            <ul>
                @foreach ($result['output'] as $output)
                    <li> {{ $output }} </li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection