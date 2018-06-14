@extends('layouts.app')

@section('content')

    <div class="ui centered grid">

        <div class="eight wide column">

            @if (session('status'))
                <div class="ui green message">{{ session('status') }}</div>
            @endif

            @include('forms.email')

        </div>

    </div>

@endsection
