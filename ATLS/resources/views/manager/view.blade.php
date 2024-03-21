@extends('layouts.app')

@section('title') Class {{$classe->name}} @endsection


@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@if(session('success'))
<div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
    {{ session('success') }}
</div>
@endif
<div>
   <div class="flex mt-10">
    <div class="bg-gray-200 px-4 py-2">
         Class {{$classe->name}}
    </div>
    <div class="bg-gray-200 px-4 py-2">
        {{$classe->grade}}
    </div>
   </div>
   <div class="bg-gray-200 px-4 py-2 rounded-lg mt-10">
    Add Student       
    </div>
    
</div>
   <table class="w-full border-collapse border border-gray-300 mt-10">
    <thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">studen name</th>
            <th class="border border-gray-300 px-4 py-2">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
            <td class="border border-gray-300 px-4 py-2 flex">
                <a href="{{route('StudentPage',$user->id)}}" class="border px-4 py-2">View</a>
                <form class="border px-4 py-2" method="POST" action="{{ route('changeClass', $user->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>



@endsection
