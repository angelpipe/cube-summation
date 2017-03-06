@extends('base')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <form id="code-form" method="POST" action="/parse">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="code">Code to run:</label>
                    <textarea class="code form-control" name="code" rows="30" required></textarea>
                </div>
                <button type="submit" class="btn btn-info">Parse</button>
            </form>
        </div>
    </div>

@endsection