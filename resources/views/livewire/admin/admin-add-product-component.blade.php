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
                    <span></span> {{ $product_id ? 'Edit' : 'Add new' }} Product
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $product_id ? 'Edit' : 'Add new' }} Product
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.products') }}" class="btn btn-success float-end">All Products</a>
                                </div>
                            </div>  
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form wire:submit.prevent="{{ $product_id ? 'updateProduct' : 'addProduct' }}">                              

                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter product name" wire:model="name" wire:keyup='generateSlug'>
                                    @error("name")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Enter product slug" wire:model="slug">
                                    @error("slug")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select class="form-control" name="category_id" wire:model="category_id">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("category_id")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>                                  

                                <div class="mb-3 mt-3">
                                    <label for="image" class="form-label">Image</label>

                                    @if($product_id)
                                        <input type="file" name="image" class="form-control" wire:model="new_image"/>
                                        @if ($new_image)
                                            <img src="{{ $new_image->temporaryUrl() }}"  title="{{ $new_image->getClientOriginalName() }}" width="120" />
                                        @else
                                            <img src="{{ asset(PRODUCT_FOLDER_PATH) }}/{{ $image }}" width="120" title="{{ $image }}"/>    
                                        @endif
                                        @error("new_image")
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input type="file" name="image" class="form-control" wire:model="image"/>
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120" title="{{ $image->getClientOriginalName() }}"/>
                                        @endif
                                        @error("image")
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror                                            
                                    @endif
                                    
                                </div>                              

                                <div class="mb-3 mt-3">
                                    <label for="short_description" class="form-label">Short Description</label>
                                    <textarea name="short_description" class="form-control" placeholder="Enter short description" wire:model="short_description"></textarea>
                                    @error("short_description")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea name="description" class="form-control" placeholder="Enter description" wire:model="description"></textarea>
                                    @error("description")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="regular_price" class="form-label">Regular Price</label>
                                    <input type="text" name="regular_price" class="form-control" placeholder="Enter regular price" wire:model="regular_price">
                                    @error("regular_price")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="sale_price" class="form-label">Sale Price</label>
                                    <input type="text" name="sale_price" class="form-control" placeholder="Enter sale price" wire:model="sale_price">
                                    @error("sale_price")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="sku" class="form-label">SKU</label>
                                    <input type="text" name="sku" class="form-control" placeholder="Enter SKU" wire:model="sku">
                                    @error("sku")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="stock_status" class="form-label">Stock Status</label>
                                    <select class="form-control" name="stock_status" wire:model="stock_status">
                                        <option value="instock" @if ($stock_status == "instock")selected @endif>InStock</option>
                                        <option value="outofstock" @if ($stock_status == "outofstock")selected @endif>Out of Stock</option>
                                    </select>
                                    @error("stock_status")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="featured" class="form-label">Featured</label>
                                    <select class="form-control" name="featured" wire:model="featured">
                                        <option value="0"  @if ($featured == "0")selected @endif>No</option>
                                        <option value="1"  @if ($featured == "1")selected @endif>Yes</option>
                                    </select>
                                    @error("featured")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="quantity" class="form-label">Quantity</label>
                                    <input type="text" name="quantity" class="form-control" placeholder="Enter product quantity" wire:model="quantity">
                                    @error("quantity")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary float-end">Submit</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>