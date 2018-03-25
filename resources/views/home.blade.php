@extends('layouts.master')

    @section('content')
        <div class="container-fluid">
        <div class="row">
            <nav class="col-sm-3 col-md-2 d-none d-sm-block bg-light sidebar">
                <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Post <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
            </nav>

            <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">
                <h1>Posts
                    <a href="{{ route('post.form') }}">
                        <button type="button" class="btn btn-primary btn-sm">Create Post</button>
                    </a>
                </h1>
                @if(Session::has('success'))
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                            <div id="message" class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        </div>
                    </div>
                @endif
                @if(!$posts->isEmpty())
                    <div class="row">
                        <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                            {{ $posts->links() }}
                        </div>
                    </div>
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>View more</th>
                        <th>Edit</th>
                        <th>Created on</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach($posts as $post)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->name }}</td>
                                <td>
                                    <a href="{{ route('post.detail', ['id' => $post->id]) }}">View more</a>
                                </td>
                                <td>
                                    <a href="{{ route('post.edit', ['id' => $post->id]) }}">Edit</a>
                                </td>
                                <td>{{ Carbon\Carbon::parse($post->created_at)->format('d-m-Y')  }}</td>
                                <td><a href="{{ route('post.delete', ['id' => $post->id]) }}" class="btn btn-danger btn-sm">Delete Post</a></td>
                            </tr>
                        @endforeach
                    @else
                        <p class="text-center text-primary">No Posts created Yet!</p>

                </table>
                @endif
            </main>
        </div>
    </div>
    @endsection