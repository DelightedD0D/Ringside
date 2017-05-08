@extends('layouts.app')

@section('header')
    <h1 class="page-title">Edit Wrestler</h1>
@endsection

@section('content')
    <div class="panel panel-bordered panel-primary">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left d-inline-block"><i class="icon fa-trophy"></i>Edit Wrestler Form</h3>
            <div class="panel-actions">
                <a class="btn btn-default pull-right" href="{{ route('wrestlers.index') }}">Back to Wrestlers</a>
            </div>
        </div>
        <div class="panel-body container-fluid">
            <div class="row row-lg">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('wrestlers.update', $wrestler->id) }}d }}">
                        {{ method_field('PATCH') }}
                        @include('wrestlers.form', [
                            'submitButtonText' => 'Update Wrestler'
                        ])
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer-scripts')
@endsection
