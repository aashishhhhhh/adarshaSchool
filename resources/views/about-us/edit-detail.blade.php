@extends('layouts.main')
@section('title','Add Detail')
@section('is_active_about_us','active')
@section('main_content')
<div class="card card-primary">
    @php
        $content=json_decode($aboutus->content);
    @endphp
    <div class="card-header">
    <h3 class="card-title">Add Detail</h3>
    </div>
    <form action="{{route('aboutus-detail.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
    <div class="card-body">
        <input type="hidden" name="aboutUsId" value="{{$aboutus->id}}" name="" id="">
    <div class="division">
        <br>
        <br>
        <label for="exampleInputEmail1">Insert a Photo if you want to update</label>
        <div class="form-group">
            <input name="photo" type="file">
        </div>
        <label> Insert Name </label>
         <div class="form-group">
            <input type="text" name="name" value="{{$content->name}}"  class="form-control" id="exampleInputEmail1" placeholder="Enter Name" >
        </div>

        <label> Insert Designation </label> 
        <div class="form-group">
              <input type="text" name="Designation" value="{{$content->Designation}}"  class="form-control" id="exampleInputEmail1" placeholder="Enter Designation" >
            </div>
        <hr>
    </div>
   
    </div>
    <div class="form-check">
    </div>
    </div>
    <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    </div>
    @endsection

    @section('scripts')
    <script>
        $('#AddDetail').click(function(){
            $('.division').append('<hr> <label> Insert Photo </label><div class="form-group"><input name="photo[]" type="file"></div> <label> Insert Name </label> <div class="form-group">  <input type="text" name="name[]"  class="form-control" id="exampleInputEmail1" placeholder="Enter Name" ></div> <label> Insert Designation </label> <div class="form-group">  <input type="text" name="Designation[]"  class="form-control" id="exampleInputEmail1" placeholder="Enter Designation" ></div>')
            // $('.division')
        });
    </script>
@endsection
