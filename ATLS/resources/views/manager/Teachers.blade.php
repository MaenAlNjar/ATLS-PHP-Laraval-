@extends('layouts.app')

@section('title') Teachers @endsection


@section('content')
<div class=" mx-auto mt-4">
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
  
   

    <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-4 w-fit">
        <div class="bg-gray-200 px-4 py-2">
        School  info       
        </div>
        <div class="">
            <table class="border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">subject</th>
                        <th class="border border-gray-300 px-4 py-2">Class Stage</th>

                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->subject ?? 'N/A' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->class_stage }}</td>
                        <td class="border border-gray-600  flex gap-10  px-4 py-2">
                            <a href="{{route('viewTeacher',$user->id)}}" class="border px-4 py-2">View</a>

                            <form style="display: inline;" class="border px-4 py-2" method="POST" action="{{route('destroy',$user->id)}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class=" px-4 py-2">Delete</button>
                            </form> 
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
   
    
</div>
@endsection

