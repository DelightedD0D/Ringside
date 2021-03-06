@extends('layouts.app')

@section('header')
    <h1 class="page-title">{{ $event->name }}</h1>
@endsection

@section('content')
    <div class="panel panel-primary panel-bordered">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left d-inline-block"><i class="icon fa-info-circle"></i>Basic Info</h3>
            <div class="panel-actions">
                <a class="btn btn-default pull-right" href="{{ route('events.index') }}">Back To All Events</a>
            </div>
        </div>
        <div class="panel-body">
            <p>{{ $event->present()->date }}</p>
            <p>{{ $event->venue->name }}</p>
        </div>
    </div>
    @foreach($event->matches as $match)
        <div class="panel panel-bordered panel-primary">
            <div class="panel-heading">
                <div class="panel-title">
                    {{ $match->present()->match_number($loop) }}
                </div>
            </div>
            <div class="panel-body">
                {{ $match->type->name }}
                <p>
                    @if ($match->titles)
                        @foreach ($match->titles as $title)
                            {{ $title->name }} Match
                        @endforeach
                    @endif
                </p>
                @if ($match->stipulations->count() > 0)
                    <p>{{ $match->present()->stipulations }} Match</p>
                @endif
                <p>
                    Referee(s): {{ $match->present()->referees }}
                </p>
                <p>
                    {{ $match->present()->wrestlers }}
                </p>
                <p>{{ $match->preview }}</p>
            </div>
        </div>
    @endforeach
@endsection
