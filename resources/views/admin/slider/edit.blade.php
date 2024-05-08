@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Edit Slider
                        <a href="{{ url('admin/slider') }}" class="btn btn-primary btn-sm text-white float-end">BACK</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="{{ url('admin/slider/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title">title</label>
                                <input type="text" name="title" value="{{ $slider->title }}" class="form-control">
                                @error('title') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="image">Image</label>
                                <input type="file" name="image" class="form-control"><br>
                                <img src="{{ asset("$slider->image") }}" height="70px" width="70px" alt="image">
                                @error('image') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="status">Status</label><br>
                                <input type="checkbox" name="status" {{ $slider->status == '1' ? 'checked':'' }} >
                                @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="col-md-12 mb-3">
                                <button type="submit" class="btn btn-primary float-end">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
