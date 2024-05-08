@extends('layouts.admin')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success">{{ session('message') }}</div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3>
                        SLIDERS
                        <a href="{{ url('admin/slider/create') }}"
                           class="btn btn-primary btn-sm text-white float-end">Add
                            Slider</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($sliders as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <img src="{{ asset("$item->image") }}" height="70px" width="70px"
                                         alt="image">
                                </td>

                                <td>{{ $item->status == '1' ? 'Private' : 'Public' }}</td>

                                <td>
                                    <a href="{{ url('admin/slider/edit/' . $item->id) }}"
                                       class="btn btn-success btn-sm">
                                        Edit
                                    </a>

                                    <a href="{{ url('admin/slider/delete/' . $item->id) }}"
                                       class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{--                    <div>--}}
                    {{--                        {{ $categories->links() }}--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@endsection
