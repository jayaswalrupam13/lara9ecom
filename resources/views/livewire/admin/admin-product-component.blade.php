<div>
    <style>
        nav svg{height: 20px;}
        nav .hidden{display: block;}
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> All Products
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-mod-6">
                                    All Products
                                </div>
                                <div class="col-mod-6"> 
                                    <a href="{{ route('admin.product.add') }}" class="btn btn-success float-end">Add New Product</a>                                   
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('message') }}
                            </div>                                
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Stock</th>
                                        <th>Price</th>
                                        <th>Categories</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = ($products->currentPage() - 1) * $products->perPage();
                                    @endphp
                                    @foreach ($products as $product)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><img src="{{ asset(PRODUCT_FOLDER_PATH)}}/{{ $product->image }}" alt="{{ ucwords($product->name) }}" title="{{ ucwords($product->name) }}" width="60px"></td>
                                        <td>{{ ucwords($product->name) }}</td>
                                        <td>{{ $product->stock_status }}</td>
                                        <td>{{ $product->regular_price }}</td>
                                        <td>{{ ucwords($product->category->name) }}</td>
                                        <td>{{ $product->created_at }}</td>
                                        <td>
                                            <a href="{{ route('admin.product.edit', ['product_id' => $product->id]) }}" class="text-info"  title="Edit">
                                                <img src="{{ asset(LOGO_FOLDER_PATH.'/edit_icon.png') }}" alt="Edit" style="width: 16px; height: 16px"> 
                                            </a> 
                                            <a onclick="deleteConfirmation({{ $product->id }})"  class="text-info" style="margin-left:40px;" title="Delete">                                                   
                                                <img src="{{ asset(LOGO_FOLDER_PATH.'/trash_icon.png') }}" alt="Delete" style="width: 16px; height: 16px;">       
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>

<div class="modal" id="deleteConfirmation">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body pb-30 pt-30">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="pb-3">Do you want to delete this record?</h4>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#deleteConfirmation">Cancel</button>
                        <button type="button" class="btn btn-danger" onclick="deleteProduct()">Delete</button>
                    </div>
                </div>
            </div>
        </div>    
    </div>   

</div>

@push('scripts')
    <script>
        function deleteConfirmation(id){
            @this.set('product_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteProduct(){
            @this.call('deleteProduct');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush