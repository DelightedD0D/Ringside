@extends('layouts.app')

@section('header')
    <h1 class="page-title">Active Wrestlers</h1>
    <a class="btn btn-primary pull-right" href="{{ route('wrestlers.create') }}">Create Wrestler</a>
@endsection

@section('content')
    <div class="panel">
        <div class="panel-body container-fluid">
            <table id="wrestlersList" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                @foreach($wrestlers as $wrestler)
                    <tr>
                        <td>{{ $wrestler->id }}</td>
                        <td>{{ $wrestler->name }}</td>
                        <td>
                            <a class="btn btn-sm btn-icon btn-flat btn-default" href="{{ route('wrestlers.edit', ['id' => $wrestler->id]) }}" data-toggle="tooltip" data-original-title="Edit">
                                <i class="icon wb-wrench" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-sm btn-icon btn-flat btn-default" href="{{ route('wrestlers.show', ['id' => $wrestler->id]) }}" data-toggle="tooltip" data-original-title="Show">
                                <i class="icon wb-eye" aria-hidden="true"></i>
                            </a>
                            <button class="btn btn-sm btn-icon btn-flat btn-default" type="button" data-toggle="tooltip" data-original-title="Delete">
                                <i class="icon wb-close" aria-hidden="true"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('footer-scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#wrestlersList').DataTable({
                "pagingType": "full_numbers",
                "columnDefs": [
                    { "width": "20px", "targets": 0 },
                    { "width": "150px", "targets": -1 },
                    { "targets": -1, "orderable": false }
                ]
            });
        } );
    </script>
@endsection