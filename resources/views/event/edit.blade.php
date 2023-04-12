@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Update Events') }}</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form action="{{ route('events.update',$event->id) }}" method="POST" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <strong>Name*</strong>
                                        <input type="text" name="name" class="form-control" placeholder="Name" value="{{ old('name', $event->name) }}" required>
                                        @error('name')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <strong>Description</strong>
                                        <textarea name="description" class="form-control" placeholder="Description">{{ old('description', $event->description) }}</textarea>
                                        @error('description')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <strong>Type*</strong>
                                        <select name="type" class="form-control" placeholder="Type" required>
                                            @foreach($types as $type)
                                                <option {{ old('type', $event->type_id) == $type->id ? "selected" : "" }} value="{{$type->id}}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('type')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <strong>Image*</strong>
                                        <input type="file" name="image" class="form-control" placeholder="Image" >
                                        @error('image')
                                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-3 d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{route('events.index')}}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
