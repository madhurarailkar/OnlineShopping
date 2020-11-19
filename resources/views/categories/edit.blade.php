<!DOCTYPE html>
<html lang="en">
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
        <div class="pull-right">
<a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
</div>
    </x-slot>
<head>
<meta charset="UTF-8">
<title>Edit Company Form - Laravel 8 Datatable CRUD Tutorial</title>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" > -->
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" >
</head>
<body>
<div class="container mt-2">

@if(session('status'))
<div class="alert alert-success mb-1 mt-1">
{{ session('status') }}
</div>
@endif
<form action="{{ route('categories.update',$company->id) }}" method="POST" enctype="multipart/form-data">
@csrf
@method('PUT')
<div class="row">
<div class="col-xs-12 col-sm-12 col-md-12">
<div class="form-group">
<strong>Category Name:</strong>
<input type="text" name="name" value="{{ $company->name }}" class="form-control" placeholder="Company name">
@error('name')
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