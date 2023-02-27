@extends('layout.app')
@section('title', 'index')
@section('products')
<div style="margin:10px;">
   <div  style="text-align: center">
<h2  class="display-3 mb-4">Product List</h2>
</div>
<table id="product_table" class="table table-dark table-hover display">
    <thead>
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">files</th>
        <th scope="col">Price</th>
        <th scope="col"></th>
        <th scope="col"></th>
        
    </tr>
</thead>
            
           <tbody>
            @forelse ($products as $key => $product)
            <tr>
                <td><a href="{{ route('products.show', ['product' => $product->id]) }}">{{ $product->name }}</a></td>

                <td>{{ $product->description }}</td>

                <td><a href="{{ route('products.fileDownload',['product' => $product->id]) }}">
                    {{ $product->filenames}}
                </a>
                </td>

                <td>{{ $product->price}}</td>

                <td><a href="{{ route('products.edit', ['product' => $product->id]) }}"><button class="btn btn-warning">Update</button></a>
                </td>

                <td>
                    <form action="{{ route('products.destroy', ['product' => $product->id]) }}" method="post">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value='Delete' class="btn btn-danger">
                    </form>
                </td>
                
            </tr>
           @empty
    
    <div>No products found. Click on Add Button, to add new products!</div>
    @endforelse
        </tbody>
        
    
    
    

    
            
        </table>
      
        <a   href="{{ route('products.create') }}"><button class="btn btn-success ">Add</button></a>
        <a   href="{{ route('products.archive') }}"><button class="btn btn-secondary ">Archived Products</button></a>
    
        
@endsection('products')

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    
    <script>
        $(document).ready(function () {
    $('#product_table').DataTable();
});
    </script>
    @endsection('script')
</div>