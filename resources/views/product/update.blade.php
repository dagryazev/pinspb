@extends('layouts.app')

@section('content')
<div class="container">
  <div class="mb-3">
    <a href="/product">Back to products</a>
  </div>
<form action="/product/update/" method="post">
  {{ csrf_field() }}
  <input type="hidden" name="id" value="{{$id}}">
  <div class="row">
    <div class="col-6">
      <input type="text" class="form-control" id="name" value="{{$name}}" name="name" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" autocomplete="off">
    </div>
    <div class="col-6">
      <input type="text" class="form-control" id="art" value="{{$art}}" name="art" placeholder="Article" aria-label="Article" aria-describedby="basic-addon1" autocomplete="off">
    </div>
  </div>
  <button type="submit" class="btn btn-primary mt-3">Update Product</button>
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
