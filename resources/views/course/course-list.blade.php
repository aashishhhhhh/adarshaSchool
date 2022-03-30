@extends('layouts.main')
@section('is_active_course','active')
@section('main_content')
@livewire('course-list', ['faculty'=>$faculty])
@endsection
@section('scripts')
    <script>
        window.addEventListener('edit-course', event=>{
      $('#edit-course').modal('show');
    });
    </script>
    <script>
        window.addEventListener('add-course', event=>{
      $('#add-course').modal('show');
    });
    </script>
  
    
@endsection