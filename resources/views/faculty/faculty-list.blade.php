@extends('layouts.main')
@section('is_active_faculty','active')
@section('main_content')
@livewire('faculty-list', ['faculty' => $faculty])
@endsection
@section('scripts')
<script>
    window.addEventListener('edit-faculty', event=>{
      $('#edit-faculty').modal('show');
    });
  </script>
  <script>
    window.addEventListener('add-faculty', event=>{
      $('#add-faculty').modal('show');
    });
  </script>
@endsection