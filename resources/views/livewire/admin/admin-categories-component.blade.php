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
                    <span></span> All Categories
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
                                    All Categories
                                </div>
                                <div class="col-mod-6">
                                    <a href="{{ route('admin.category.add') }}" class="btn btn-success float-end">Add New Category</a>
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
                                        <th>Slug</th>
                                        <th>Popular</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $index = ($categories->currentPage() - 1) * $categories->perPage();
                                    @endphp
                                    @foreach ($categories as $category)
                                    <tr>
                                        <td>{{ ++$index }}</td>
                                        <td><img src="{{ asset(CATEGORY_FOLDER_PATH) }}/{{ $category->image }}" alt="{{ $category->image }}" title="{{ $category->image }}"
                                            width="80" /></td>
                                        <td>{{ ucwords($category->name) }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>{{ $category->is_popular == 1 ? 'Yes' : 'No' }}</td>
                                        <td>
                                            <a href="{{ route('admin.category.edit', ['category_id' => $category->id]) }}" class="text-info"  title="Edit">
                                                <img src="{{ asset(LOGO_FOLDER_PATH.'/edit_icon.png') }}" alt="Edit" style="width: 16px; height: 16px"> 
                                            </a> 
                                            <a onclick="deleteConfirmation({{ $category->id }})"  class="text-info" style="margin-left:40px;" title="Delete">                                                   
                                                <img src="{{ asset(LOGO_FOLDER_PATH.'/trash_icon.png') }}" alt="Delete" style="width: 16px; height: 16px;">       
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $categories->links() }}
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
                        <button type="button" class="btn btn-danger" onclick="deleteCategory()">Delete</button>
                    </div>
                </div>
            </div>
        </div>    
    </div>   

</div>

@push('scripts')
    <script>
        function deleteConfirmation(id){
            @this.set('category_id', id);
            $('#deleteConfirmation').modal('show');
        }

        function deleteCategory(){
            @this.call('deleteCategory');
            $('#deleteConfirmation').modal('hide');
        }
    </script>
@endpush