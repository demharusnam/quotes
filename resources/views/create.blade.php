@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Add Quote
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div><br />
            @endif
            <form method="post" action="{{ route('quotes.store') }}">
                <div class="form-group">
                    @csrf
                    <label for="name">Season:</label>
                    <input type="text" class="form-control" name="season"/>
                </div>
                <div class="form-group">
                    <label for="price">Episode:</label>
                    <input type="text" class="form-control" name="episode"/>
                </div>
                <div class="form-group">
                    <label for="price">Quote:</label>
                    <input type="text" class="form-control" name="quote"/>
                </div>
                <button type="submit" class="btn btn-primary">Create Quote</button>
            </form>
        </div>
    </div>
@endsection
