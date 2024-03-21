@extends('layouts.app')

@section('title') Main page @endsection


@section('content')
<div class="bg-gray-200 px-4 py-2 rounded-lg">
    School Class       
</div>
<div>
    <table class=" border-collapse border border-gray-300 w-fit">
        <thead>
            <tr>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Grade</th>
                <th class="border border-gray-300 px-4 py-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($classe as $class)
            @if($class->class_stage == $user->class_stage)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $class->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $class->grade }}</td>
                <td class="border border-gray-300  flex justify-center gap-10">
                    <a href="{{url('/classView/'.$class->id.'/class')}}" class="border px-4 py-2 ">View</a>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
    
</div>

@endsection
