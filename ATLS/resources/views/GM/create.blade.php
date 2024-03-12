@extends('layouts.app')

@section('title') Create school @endsection

@section('content')
@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
    {{session('error')}}    
</div>
@endif
@if(session('success'))
<div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
    {{ session('success') }}
</div>
@endif
<form method="POST" action="{{ route('createSchool') }}" class="max-w-md mx-auto bg-white p-6 rounded-md shadow-md">
    @csrf
    <div class="mb-4">
        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
        <input name="name" id="name" type="text" class="form-input rounded-md border-gray-300 w-full focus:border-indigo-500" value="{{ old('name') }}">
    </div>
    <div class="mb-4">
        <label for="address" class="block text-gray-700 text-sm font-bold mb-2">Address</label>
        <textarea name="address" id="address" class="form-textarea rounded-md border-gray-300 w-full focus:border-indigo-500">{{ old('address') }}</textarea>
    </div>
    <div class="mb-4">
        <input type="hidden" name="created_by" value="{{ Auth::user()->name }}">

    </div>
    <button type="submit" class="bg-indigo-500 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Submit</button>
</form>
@endsection
