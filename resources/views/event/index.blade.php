@extends('layouts.app')
@section('style')
    <style>
        .event-image{
            max-height: 50px;
            max-width: 50px;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="d-flex justify-content-between mb-3">
                    <h3>{{ __('Events') }}</h3>
                    <a class="btn btn-success" href="{{ route('events.create') }}">Craete</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if($events->count())
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Sr. No</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Image</th>
                                    <th width="280px">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->id }}</td>
                                        <td>{{ $event->name }}</td>
                                        <td>{{ $event->type->name }}</td>
                                        <td>
                                            <img src="{{ $event->image_url }}" class="event-image"/>
                                        </td>
                                        <td>
                                            <form action="{{ route('events.destroy',$event->id) }}" method="Post">
                                                <a class="btn btn-primary" href="{{ route('events.edit',$event->id) }}">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $events->links('pagination::bootstrap-4') }}
                        @else
                            No event available.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

