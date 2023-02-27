@extends('layout.app')
@section('title', 'Create')
@section('products')
    <div>

        <h2 style="text-align: center" class="display-3 mb-4">Add New Product</h2>


        <form action="{{ route('products.store') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Enter The Product Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name' , optional($product ?? null)->name) }}">
            </div>
            @error('name')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
            <div class="mb-3">
                <label for="description" class="form-label">Enter The Product Description</label>
                <textarea name="description" id="description" class="form-control" cols="10" rows="5">{{ old('description' , optional($product ?? null)->description)  }}</textarea>
            </div>
            @error('description')
<div class="alert alert-danger">{{ $message }}</div>
@enderror

<div class="mb-3">
    <label for="filenames" class="form-label">Upload Files</label>
    <input type="file" name="filenames" id="filenames" class="form-control" value="{{ old('filenames' , optional($product ?? null)->filenames)  }}">
</div>
    @error('filenames')
<div class="alert alert-danger">{{ $message }}</div>
@enderror
            <div class="mb-3" >
                <label for="price" class="form-label">Enter The Product Price</label>
                <input type="number" name="price" id="price" class="form-control" value="{{ old('price' , optional($product ?? null)->name) }}">
            </div>
            @error('price')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <div class="d-grid"><input type="submit" value="Create" class="btn btn-primary btn-block"></div>
        </form>
    </div>
@endsection