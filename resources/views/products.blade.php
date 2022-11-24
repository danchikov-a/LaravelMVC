@extends('layouts.app')
@section('content')
    <form action="{{ route('productsExport') }}" method="post">
        @csrf
        <button id="exportButton" class="btn btn-primary">Export catalog</button>
    </form>
    <form class="user-form" action="{{ route('productsStore') }}" method="post">
        @csrf
        <caption>Product add form</caption>
        <div class="form-group form-element">
            <label for="name">Name</label>
            <input name="name" type="text" id="name">
        </div>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror
        <div class="form-group form-element">
            <label for="description">Description</label>
            <input name="description" type="text" id="description">
        </div>
        @error('description')
            <div class="error">{{ $message }}</div>
        @enderror
        <div class="form-group form-element">
            <label for="manufacture">Manufacture</label>
            <input name="manufacture" type="text" id="manufacture">
        </div>
        @error('manufacture')
            <div class="error">{{ $message }}</div>
        @enderror
        <div class="form-group form-element">
            <label for="releaseDate">Release date</label>
            <input name="releaseDate" type="text" id="releaseDate">
        </div>
        @error('releaseDate')
            <div class="error">{{ $message }}</div>
        @enderror
        <div class="form-group form-element">
            <label for="cost">Cost</label>
            <input name="cost" type="text" id="cost">
        </div>
        @error('cost')
            <div class="error">{{ $message }}</div>
        @enderror
        <button id="addProductButton" class="btn btn-primary">Add product</button>
    </form>

    <select class="user-form form-select" onchange="window.location.href=this.options[this.selectedIndex].value;">
        <option>Sort</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'name_asc'])}}">Name from a to z</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'name_desc'])}}">Name from z to a</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'manufacture_asc'])}}">Manufacture from a to z</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'manufacture_desc'])}}">Manufacture from z to a</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'releaseDate_asc'])}}">Oldest</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'releaseDate_desc'])}}">Newest</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'cost_asc'])}}">Cheaper</option>
        <option value="{{request()->fullUrlWithQuery(['sort' => 'cost_desc'])}}">More expensive</option>
    </select>

    <form class="user-form">
        <div>
            Manufacture<input name="manufacture">
        </div>
        <div>
            Cost
            <div>
                From<input name="costFrom" placeholder="0">
            </div>
            <div>
                To<input name="costTo" placeholder="0">
            </div>
        </div>

        <button id="showProductsButton" class="btn btn-primary">Show products</button>
    </form>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Manufacture</th>
            <th scope="col">Release date</th>
            <th scope="col">Cost</th>
            <th scope="col">UsdCost</th>
            <th scope="col">Add to cart</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($products as $product)
            <tr>
                <td><a href="{{ route('productsShow', $product->id) }}">{{ $product->name }}</a></td>
                <td>{{$product->manufacture }}</td>
                <td>{{ $product->releaseDate }}</td>
                <td>{{ $product->cost }}</td>
                <td>{{ $product->usdCost }}</td>
                <td>
                    <a class="btn btn-outline-success"
                       href="{{ route('productsShow', $product->id) }}">Add</a>
                </td>
                <td>
                    <a class="btn btn-outline-dark" href="{{ route('productsEdit', $product->id) }}">Update</a>
                </td>
                <td>
                    <form action="{{ route('productsDestroy', $product->id) }}" method="post">
                        <input type="submit" class="btn btn btn-outline-danger" value="Delete"/>
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('partials.pagination', ['paginationArray' => $products->links()])
@endsection
