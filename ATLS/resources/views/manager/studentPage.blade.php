@extends('layouts.app')

@section('title') Class @endsection


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
  
   <div class="bg-gray-200 px-4 py-2 rounded-lg mt-10">
    Add Student       
    </div>
    <form method="POST" action="{{ route('addMark') }}" class="flex gap-10">
        @csrf
        @method('POST')
    
        <div class="mb-4">
            <label for="user_id" class="block text-sm font-medium text-gray-700">{{$user->first()->name}}</label>
            <input type="hidden" name="user_id" value="{{ $user->first()->id }}">

        </div>
    
        <div class="mb-4">
            <label for="study_materials_id" class="block text-sm font-medium text-gray-700">Study Material</label>
            <select id="study_materials_id" name="study_materials_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                @foreach($StudyMaterials as $StudyMaterial)
                    <option value="{{ $StudyMaterial->id }}">- {{ $StudyMaterial->subject_name }} -</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-4">
            <label for="mark_one" class="block text-sm font-medium text-gray-700">Mark One</label>
            <input type="text" id="mark_one" name="mark_one" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter Mark One">
        </div>
    
        <div class="mb-4">
            <label for="mark_two" class="block text-sm font-medium text-gray-700">Mark Two</label>
            <input type="text" id="mark_two" name="mark_two" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter Mark Two">
        </div>
    
        <div class="mb-4">
            <label for="mark_final" class="block text-sm font-medium text-gray-700">Mark Three</label>
            <input type="text" id="mark_final" name="mark_final" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Enter Mark Three">
        </div>
    
        <div class="mb-4 mt-4">
            <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
            <button type="submit" class="inline-flex justify-center w-32 h-12 shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Submit
            </button>
        </div>
    </form>
</div>
   <table class="w-full border-collapse border border-gray-300 mt-10">
    <thead>
        <tr>
            <th class="border border-gray-300 px-4 py-2">subject name</th>
            <th class="border border-gray-300 px-4 py-2">make 1</th>
            <th class="border border-gray-300 px-4 py-2">mark 2 </th>
            <th class="border border-gray-300 px-4 py-2">mark 3</th>
        </tr>
    </thead>
    <tbody>
        @foreach($marks as $mark)
        <tr>
            <td class="border border-gray-300 px-4 py-2">{{ $mark->studyMaterial->subject_name }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $mark->mark_one }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $mark->mark_two }}</td>
            <td class="border border-gray-300 px-4 py-2">{{ $mark->mark_final }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>

</div>



@endsection
