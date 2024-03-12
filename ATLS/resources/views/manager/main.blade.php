@extends('layouts.app')

@section('title') Main page @endsection


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
    <div>
        <div class="bg-gray-200 px-4 py-2 rounded-lg">
            Add study materials       
            </div>
        <form method="POST" action="{{route('addMaterials')}}" class="  flex gap-10">
            @csrf
            <div class="mb-4">
                <label for="subject_name" class="block text-sm font-medium text-gray-700">subject name</label>
                <input type="text" id="subject_name" name="subject_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter name">
            </div>
            <div class="mb-4 mt-4">
                <input type="hidden" name="school_id" value="{{Auth::user()->school_id}}">
                <button type="submit" class="inline-flex justify-center  w-32 h-12 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Submit
                </button>
            </div>
            
        </form>
    </div>
   

    <div class="bg-white rounded-lg shadow-lg overflow-hidden mt-4 w-96">
        <div class="bg-gray-200 px-4 py-2">
        School  info       
        </div>
        <div class="">
            <table class="w-96 border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">sub</th>
                        <th class="border border-gray-300 px-4 py-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->subject ?? 'N/A' }}</td>
                        <td class="border border-gray-600  flex gap-10">
                            <form style="display: inline;" class=" px-4 py-2" method="POST" action="{{route('destroy',$user->id)}}">
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

