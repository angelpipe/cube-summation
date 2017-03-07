@extends ('base')

@section ('content')

    <div class="row">
        <div class="col-md-12">
            <form id="code-form" method="POST" action="/parse">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="input">Code to run:</label>
                    <textarea class="code form-control" name="input" rows="20" required></textarea>
                </div>
                <button type="submit" class="btn btn-info">Execute</button>
            </form>
        </div>
    </div>

@endsection