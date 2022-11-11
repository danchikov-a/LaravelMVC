@extends('layout.baseLayout')
@section('content')

    <form class="user-form" action="{{route('productsStore')}}" method="post">
        @csrf
        <caption>Product add form</caption>
        <div class="form-group form-element">
            <label for="name">Name</label>
            <input name="name" type="text" id="name">
        </div>
        @if($errors->has('name'))
            <div class="error">{{ $errors->first('name') }}</div>
        @endif
        <div class="form-group form-element">
            <label for="description">Description</label>
            <input name="description" type="text" id="description">
        </div>
        @if($errors->has('description'))
            <div class="error">{{ $errors->first('description') }}</div>
        @endif
        <div class="form-group form-element">
            <label for="manufacture">Manufacture</label>
            <input name="manufacture" type="text" id="manufacture">
        </div>
        @if($errors->has('manufacture'))
            <div class="error">{{ $errors->first('manufacture') }}</div>
        @endif
        <div class="form-group form-element">
            <label for="releaseDate">Release date</label>
            <input name="releaseDate" type="text" id="releaseDate">
        </div>
        @if($errors->has('releaseDate'))
            <div class="error">{{ $errors->first('releaseDate') }}</div>
        @endif
        <div class="form-group form-element">
            <label for="cost">Cost</label>
            <input name="cost" type="text" id="cost">
        </div>
        @if($errors->has('cost'))
            <div class="error">{{ $errors->first('cost') }}</div>
        @endif
        <button id="addProductButton" class="btn btn-primary">Add product</button>
    </form>

    <select class="form-select" onchange="window.location.href=this.options[this.selectedIndex].value;">
        <option>Sort</option>
        <option value="{{route('productsIndex', ['sort' => 'name_desc'])}}">Name from a to z</option>
        <option value="{{route('productsIndex', ['sort' => 'name_desc'])}}">Name from z to a</option>
        <option value="{{route('productsIndex', ['sort' => 'manufacture_asc'])}}">Manufacture from a to z</option>
        <option value="{{route('productsIndex', ['sort' => 'manufacture_desc'])}}">Manufacture from z to a</option>
        <option value="{{route('productsIndex', ['sort' => 'releaseDate_asc'])}}">Oldest</option>
        <option value="{{route('productsIndex', ['sort' => 'releaseDate_desc'])}}">Newest</option>
        <option value="{{route('productsIndex', ['sort' => 'cost_asc'])}}">Cheaper</option>
        <option value="{{route('productsIndex', ['sort' => 'cost_desc'])}}">More expensive</option>
    </select>

    <table class="table table-bordered table-hover">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Manufacture</th>
            <th scope="col">Release date</th>
            <th scope="col">Cost</th>
            <th scope="col">Add to cart</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        @foreach ($products as $product)
            <tr>
                <td><a href="{{route('productsShow', $product->id)}}">{{$product->name}}</a></td>
                <td>{{$product->manufacture }}</td>
                <td>{{ $product->releaseDate }}</td>
                <td>{{ $product->cost }}</td>
                <td>
                    <a class="btn btn-outline-success"
                       href="{{route('productsShow', $product->id)}}">Add</a>
                </td>
                <td>
                    <a class="btn btn-outline-dark" href="{{route('productsEdit', $product->id)}}">Update</a>
                </td>
                <td>
                    <form action="{{route('productsDestroy', $product->id)}}" method="post">
                        <input class="btn btn btn-outline-danger" type="submit" value="Delete"/>
                        @method('delete')
                        @csrf
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
@endsection
