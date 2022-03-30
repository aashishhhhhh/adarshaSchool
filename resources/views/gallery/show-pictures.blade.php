@extends('layouts.main')
@section('is_active_gallery','active')
@section('main_content')
@livewire('show-pictures', ['gallery' => $gallery])
@endsection