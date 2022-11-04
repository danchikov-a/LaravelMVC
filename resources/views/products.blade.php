@include('header')

<form class="user-form" action="/products" method="post">
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
    <button id="addProductButton" class="btn btn-primary" >Add product</button>
</form>

<table class="table table-bordered table-hover">
    <thead class="thead-dark">
    <tr>
        <th scope="col">Name</th>
        <th scope="col">Manufacture</th>
        <th scope="col">Release date</th>
        <th scope="col">Cost</th>
        <th scope="col">Add to cart</th>
    </tr>
    </thead>
    <tbody>

    @foreach ($products as $product)
        <tr>
            <td><a href="products/{{ $product->id }}">{{$product->name}}</a></td>
            <td>{{$product->manufacture }}</td>
            <td>{{ $product->releaseDate }}</td>
            <td>{{ $product->cost }}</td>
            <td>
                <a class="btn btn-outline-success"
                   href="products/{{ $product->id }}">Add</a>
            </td>
        </tr>
    @endforeach

    </tbody>
</table>
@include('footer')
