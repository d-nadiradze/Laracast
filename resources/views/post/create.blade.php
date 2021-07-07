@extends('base')
@section('content')
    <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
        @csrf
<div class="form-group">
    <label class="form-control" for="title">Title</label>
    <input name="title" class="form-control">
</div>
<div class="form-group">
    <label class="form-control" for="body">Body</label>
    <input name="body" class="form-control">
</div>
<div class="form-group">
    <label class="form-control" for="excerpts">Excerpts</label>
    <input name="excerpt" class="form-control">
</div>
<div class="form-group">
    <label class="form-control" for="Slug">Slug</label>
    <input name="slug" class="form-control" placeholder="Slug">
</div>
<div class="form-group">
    <label class="form-control" for="category_id">Choose Category</label>
    <select name="category_id" class="form-control">
        @foreach($categories as $category)
        <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
    </select>
</div>
<div class="form-group">
    <label class="form-control" for="user_id">Choose User</label>
    <select name="user_id" class="form-control">
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->username}}</option>
        @endforeach
    </select>
</div>
<button type="submit">Save</button>
    </form>






    @endsection
