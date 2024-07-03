<div>
    <style>
        nav svg {
            height: 20px;
        }

        nav .hidden {
            display: block;
        }
    </style>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="/" rel="nofollow">Home</a>
                    <span></span> {{ $slide_id ? 'Edit' : 'Add new' }} Slide
                </div>
            </div>
        </div>
        <section class="mt-50 mb-50">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{ $slide_id ? 'Edit' : 'Add new' }} Slide
                                    </div>
                                    <div class="col-md-6">
                                        <a href="{{ route('admin.home.slider') }}" class="btn btn-success float-end">All
                                            Slides</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (Session::has('message'))
                                <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                                @endif
                                <form wire:submit.prevent="{{ $slide_id ? 'updateSlide' : 'addSlide' }}">
                                @php
                                    $fields = ['top_title', 'title', 'sub_title', 'offer', 'link'];
                                @endphp

                                @foreach ($fields as $field)
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">{{ snake_to_title_case($field) }}</label>
                                        <input type="text" class="form-control" placeholder="Enter {{ strtolower(snake_to_title_case($field)) }}" wire:model="{{ $field }}">
                                        @error($field)
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>    
                                @endforeach      
                                    
                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Image</label>

                                        @if($slide_id)
                                            <input type="file" class="form-control" wire:model="new_image">
                                            @if($new_image)
                                                <img src="{{ $new_image->temporaryUrl() }}" title="{{ $new_image->getClientOriginalName() }}" width="100" alt="{{ $new_image->getClientOriginalName() }}">
                                            @else
                                                <img src="{{ asset(SLIDER_FOLDER_PATH) }}/{{ $image }}" width="120" title="{{ $image }}"/>    
                                            @endif
                                            @error("new_image")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        @else
                                            <input type="file" class="form-control" wire:model="image">
                                            @if($image)
                                                <img src="{{ $image->temporaryUrl() }}" title="{{ $image->getClientOriginalName() }}" width="100" alt="{{ $image->getClientOriginalName() }}">
                                            @endif
                                            @error("image")
                                            <p class="text-danger">{{ $message }}</p>
                                            @enderror                                            
                                        @endif
                                        
                                    </div>

                                    <div class="mb-3 mt-3">
                                        <label class="form-label">Status</label>
                                        <select wire:model="status" class="form-select">
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>   
                                        @error("status")
                                        <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary float-end">Submit</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>