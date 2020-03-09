@extends('layouts.app')

@section('content')
    <style>
        .uper {
            margin-top: 40px;
        }
    </style>
    <div class="card uper">
        <div class="card-header">
            Update Quotes
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
            <form method="post" action="{{ route('quotes.update', $quote->id) }}">
                <div class="form-group">
                    @csrf
                    @method('PATCH')
                    <label for="price">Season:</label>
                    <input type="text" class="form-control" name="season" value="{{ $quote->season }}"/>
                </div>
                <div class="form-group">
                    <label for="price">Episode:</label>
                    <input type="text" class="form-control" name="episode" value="{{ $quote->episode }}"/>
                </div>
                <div class="form-group">
                    <label for="name">Quote:</label>
                    <input type="text" class="form-control" name="quote" value="{{ $quote->quote }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Update Quote</button>
            </form>
        </div>
    </div>
@endsection
