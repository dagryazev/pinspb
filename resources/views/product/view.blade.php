@extends('layouts.app')

@section('content')
<div class="container">
  @if (count($products))
  <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Article</th>
      <th scope="col">Created at</th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($products as $product)
      <tr>
        <th scope="row">{{$product->id}}</th>
        <td><a href="/product/{{$product->id}}">{{$product->name}}</a></td>
        <td>{{$product->art}}</td>
        <td>{{$product->created_at}}</td>
        <td><a href="/product/delete/{{$product->id}}">x</a></td>
      </tr>
    @endforeach
  </tbody>
</table>
@endif
<form action="/product/create/" method="post">
  {{ csrf_field() }}
  <div class="row">
    <div class="col-6">
      <input type="text" class="form-control" id="name" name="name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" autocomplete="off">
    </div>
    <div class="col-6">
      <input type="text" class="form-control" id="art" name="art" placeholder="Article" aria-label="Article" aria-describedby="basic-addon1" autocomplete="off">
    </div>
  </div>
  <button type="submit" class="btn btn-primary mt-3">Create Product</button>
</form>
  @if (isset($success))
  <div class="alert alert-primary mt-3" role="alert">
    {{$success}}
  </div>
  @endif
  @if (isset($error))
  <div class="alert alert-danger mt-3" role="alert">
    {{$error}}
  </div>
  @endif
</div>
@endsection
