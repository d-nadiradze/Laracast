@extends('base')
@section('content')
    <a href="{{route('post.create')}}">
    <button class="btn btn-success" style="padding-left: 200px;text-align: center;" >Add </button>
    </a>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Slug</th>
            <th scope="col">Excerpt</th>
            <th scope="col">Category</th>
            <th scope="col">Author</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->title}}</td>
            <td>{{$item->body}}</td>
            <td>{{$item->slug}}</td>
            <td>{{$item->excerpt}}</td>
            <td>{{$item->category->name}}</td>
            <td>{{$item->author->username}}</td>
            <td>
                <a href="{{route('post.updateId',[$item->id])}}">Update</a>
                <a href="{{route('post.destroy',[$item->id])}}">Delete</a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
@endsection
