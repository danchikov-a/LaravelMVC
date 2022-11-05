@include('header')
<form class="user-form" action="/products/{{$product->id}}" method="post">
    @csrf
    @method('put')
    <caption>Product add form</caption>
    <div class="form-group form-element">
        <label for="name">Name</label>
        <input name="name" type="text" id="name" value="{{$product->name}}">
    </div>
    @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
    @endif
    <div class="form-group form-element">
        <label for="description">Description</label>
        <input name="description" type="text" id="description" value="{{$product->description}}">
    </div>
    @if($errors->has('description'))
        <div class="error">{{ $errors->first('description') }}</div>
    @endif
    <div class="form-group form-element">
        <label for="manufacture">Manufacture</label>
        <input name="manufacture" type="text" id="manufacture" value="{{$product->manufacture}}">
    </div>
    @if($errors->has('manufacture'))
        <div class="error">{{ $errors->first('manufacture') }}</div>
    @endif
    <div class="form-group form-element">
        <label for="releaseDate">Release date</label>
        <input name="releaseDate" type="text" id="releaseDate" value="{{$product->releaseDate}}">
    </div>
    @if($errors->has('releaseDate'))
        <div class="error">{{ $errors->first('releaseDate') }}</div>
    @endif
    <div class="form-group form-element">
        <label for="cost">Cost</label>
        <input name="cost" type="text" id="cost" value="{{$product->cost}}">
    </div>
    @if($errors->has('cost'))
        <div class="error">{{ $errors->first('cost') }}</div>
    @endif
    <button id="addProductButton" class="btn btn-primary" >Update product</button>
</form>
@include('footer')
