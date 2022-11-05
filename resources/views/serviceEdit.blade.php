@include('header')
<form class="user-form" action="/services/{{$service->id}}" method="post">
    @csrf
    @method('put')
    <caption>service add form</caption>
    <div class="form-group form-element">
        <label for="name">Name</label>
        <input name="name" type="text" id="name" value="{{$service->name}}">
    </div>
    @if($errors->has('name'))
        <div class="error">{{ $errors->first('name') }}</div>
    @endif
    <div class="form-group form-element">
        <label for="deadline">Deadline</label>
        <input name="deadline" type="text" id="deadline" value="{{$service->deadline}}">
    </div>
    @if($errors->has('releaseDate'))
        <div class="error">{{ $errors->first('releaseDate') }}</div>
    @endif
    <div class="form-group form-element">
        <label for="cost">Cost</label>
        <input name="cost" type="text" id="cost" value="{{$service->cost}}">
    </div>
    @if($errors->has('cost'))
        <div class="error">{{ $errors->first('cost') }}</div>
    @endif
    <button id="addServiceButton" class="btn btn-primary" >Update service</button>
</form>
@include('footer')
