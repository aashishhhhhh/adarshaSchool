@extends('layouts.main')
@section('is_active_gallery','active')
@section('main_content')
<div class="card text-sm ">
    @if (session()->has('msg'))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{session('msg')}}</strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
    <div class="card">
        <div class="card-header">
            <div class="row my-1">
                <div class="col-md-6" style="margin-bottom:-5px;">
                    <p class="">{{ __('Gallery') }}</p>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{route('gallery.create')}}"
                        class="btn btn-sm btn-primary">{{ __('Add Gallery') }}
                        <i class="fas fa-plus px-1"></i></a>
                        
                </div>
                <div class="col-md-6 text-right">

            </div>
        <div class="card-tools">
        <div class="input-group input-group-sm" style="width: 150px;">
        
        </div>
        </div>
        </div>
        
        <div class="card-body table-responsive p-0" style="height: 300px;">
        <table class="table table-head-fixed text-nowrap">
        <thead>
        <tr>
        <th>title</th>
        <th>Photos</th>
        <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($gallery->pages as $key=> $value)
            @php
                $data=json_decode($value->content,true);
            @endphp
        <tr>
        <td>{{$data['title']}}</td>
        <td> <a class="btn btn-primary" href="{{route('showPhotos',$value)}}"
            target="_blank"> Show Photos <i class="fas fa-eye"></i> </a></td>
            <td><a class="btn btn-primary" href="{{route('gallery.edit',$value->id)}}"
                > <i class="fas fa-edit"></i>Edit </a>
                <a class="btn btn-primary" href="{{route('gallery-delete',$value->id)}}"
                    ><i class="fas fa-trash"></i>Delete </a>
            </td>
        </tr>
        @endforeach
        </tbody>
        </table>
        </div>
        
        </div>
    <!-- /.card-body -->
</div>
@endsection