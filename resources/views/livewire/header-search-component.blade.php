<div class="search-style-1">
    <form action="{{ route('product.search') }}">                                
        <input type="text" placeholder="Search for items..." name="q" value={{ $q }}>
    </form>
</div>