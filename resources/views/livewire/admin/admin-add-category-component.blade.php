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
                    <span></span> {{ $category_id ? 'Edit' : 'Add new' }} Category
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
                                    {{ $category_id ? 'Edit' : 'Add new' }} Category
                                </div>
                                <div class="col-md-6">
                                    <a href="{{ route('admin.categories') }}" class="btn btn-success float-end">All Categories</a>
                                </div>
                            </div>  
                        </div>
                        <div class="card-body">
                            @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                            @endif
                            <form wire:submit.prevent="{{ $category_id ? 'updateCategory' : 'storeCategory' }}">

                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter category name" wire:model="name" wire:keyup='generateSlug'>
                                    @error("name")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="name" class="form-label">Slug</label>
                                    <input type="text" name="slug" class="form-control" placeholder="Enter category slug" wire:model="slug">
                                    @error("slug")
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-3 mt-3">
                                    <label for="image" class="form-label">Image</label>

                                    @if($category_id)
                                        <input type="file" class="form-control" wire:model="new_image">
                                        @if($new_image)
                                            <img src="{{ $new_image->temporaryUrl() }}" title="{{ $new_image->getClientOriginalName() }}" width="100" alt="{{ $new_image->getClientOriginalName() }}">
                                        @else
                                            <img src="{{ asset(CATEGORY_FOLDER_PATH) }}/{{ $image }}" width="120" title="{{ $image }}"/>    
                                        @endif
                                        @error("new_image")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    @else
                                        <input type="file" class="form-control" wire:model="image"/>
                                        @if ($image)
                                            <img src="{{ $image->temporaryUrl() }}" width="120" alt="{{ $image->getClientOriginalName() }} title="{{ $image->getClientOriginalName() }}"/>
                                        @endif
                                        @error("image")
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    @endif              
                                </div>    

                                <div class="mb-3 mt-3">
                                    <label for="is_popular" class="form-label">Popular</label>
                                    <select class="form-control" name="is_popular" wire:model="is_popular">
                                        <option value="0"  @if ($is_popular == "0")selected @endif>No</option>
                                        <option value="1"  @if ($is_popular == "1")selected @endif>Yes</option>
                                    </select>
                                    @error("is_popular")
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