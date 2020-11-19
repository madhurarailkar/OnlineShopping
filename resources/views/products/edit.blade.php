<!DOCTYPE html>
<html lang="en">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
            <div class="pull-right">
<a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
</div>
        </h2>
    </x-slot>
<head>
<meta charset="UTF-8">
<title>Edit Product</title>
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
</head>
<body>
<div class="container mt-2">

@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="{{ route('products.update',$company->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Product Name:</strong>
<input type="text" name="title" value="{{ $company->title }}" class="form-control" placeholder="Product name">
@error('name')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Category:</strong>
<select class="form-control" name="category_id">
   
  <option>Select Product</option>
    
  @foreach ($category as $key => $value)
    <option value="{{ $key }}" {{$company->category_id == $key ? "selected" : "" }}>
        {{ $value }} 
    </option>
  @endforeach    
</select>@error('category_id')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Product description:</strong>
<input type="text" name="description" value="{{ $company->description }}" class="form-control" placeholder="Product Description">
@error('description')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>


<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Product Price:</strong>
<input type="text" name="price" value="{{ $company->price }}" class="form-control" placeholder="Product Price">
@error('price')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>

<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Product Image:</strong>
@if($company->image)
<img id="original" src="{{ url('/image/'.$company->image) }}" height="70" width="70">
@endif
<input type="file" name="image" class="form-control" placeholder="">
@error('image')
<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
@enderror
</div>
</div>

<button type="submit" class="btn btn-primary ml-3">Submit</button>
</div>
</form>
</div>
</body>
</html>
</x-app-layout>
