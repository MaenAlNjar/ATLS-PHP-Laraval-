<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', $title)</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>
<body>
    
    @auth
        @if(Auth::user()->role === 'GM')
            <nav class="bg-gray-100 shadow">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center py-4">
                        <a class="text-lg font-bold" href="">Test</a>
                        <div class="hidden lg:flex lg:items-center lg:w-auto" id="menu">
                            <nav>
                                <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                                    <li><a href="{{url('/GM/mainpage')}}" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Main</a></li>
                                    <li class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit">Logout</button>
                                        </form>
                                    </li> 
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex">
                <div class="w-1/5 p-5">
                    <p class="py-4 px-2 bg-amber-100">Welcome, {{ Auth::user()->name }}</p>           
                   
                </div>
        @elseif(Auth::user()->role === 'manager')
            <nav class="bg-gray-100 shadow">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center py-4">
                        <a class="text-lg font-bold" href="">Test</a>
                        <div class="hidden lg:flex lg:items-center lg:w-auto" id="menu">
                            <nav>
                                <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                                    <li><a href="/manager/mainpage" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Main page </a></li>
                                    <li class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit">Logout</button>
                                        </form>
                                    </li> 
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex sidebar" >
                <div class="w-1/5 p-5 border rounded-r-lg border-black sidebar ">
                    <p class="py-4 px-2 bg-amber-100">Welcome, {{ Auth::user()->name }}</p>           
              <ul class="mt-10">
                <li><a href="/createClass" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Class Setting </a><li>
                <li><a href="/addUser" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Add Student/Teacher</a><li>
                <li><a href="/Teachers" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Teacher</a><li>


              </ul>
                </div>
        @elseif(Auth::user()->role === 'teacher')
            <nav class="bg-gray-100 shadow">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center py-4">
                        <a class="text-lg font-bold" href="">Test</a>
                        <div class="hidden lg:flex lg:items-center lg:w-auto" id="menu">
                            <nav>
                                <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                                    <li><a href="/teacher/mainpage" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Main page</a></li>
                                    <li class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit">Logout</button>
                                        </form>
                                    </li> 
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex">
                <div class="w-1/5 p-5">
                    <p class="py-4 px-2 bg-amber-100">Welcome, {{ Auth::user()->name }}</p>           
                    <ul class="mt-10">
                        <li><a href="/teacher/class" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Class And Student</a><li>
                        <li><a href="/teacher/schedule" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Schedule</a><li>
                      </ul>
                </div>
        @elseif(Auth::user()->role === 'student')
            <nav class="bg-gray-100 shadow">
                <div class="container mx-auto px-4">
                    <div class="flex justify-between items-center py-4">
                        <a class="text-lg font-bold" href="">Test</a>
                        <div class="hidden lg:flex lg:items-center lg:w-auto" id="menu">
                            <nav>
                                <ul class="lg:flex items-center justify-between text-base text-gray-700 pt-4 lg:pt-0">
                                    <li><a href="/student/mainpage" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Main page</a></li>
                                    <li class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit">Logout</button>
                                        </form>
                                    </li> 
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="flex">
                <div class="w-1/5 p-5">
                    <p class="py-4 px-2 bg-amber-100">Welcome {{ Auth::user()->name }}</p>           
                    <div>
                        <ul class="mt-10">
                            <li><a href="/student/class" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Class</a><li>
                            <li><a href="/student/schedule" class="lg:p-4 py-2 block border-b-2 border-transparent hover:border-indigo-500">Schedule</a><li>
                          </ul>
                    </div>
                </div>
        @endif
    @else
    <nav class="bg-gray-100 shadow">
        <div class="container mx-auto ">
            <div class="flex justify-between items-center py-4">
                <a class="text-lg font-bold" href="">Test</a>
                <div class="hidden lg:flex lg:items-center lg:w-auto" id="menu">
                    <nav>
                        
                    </nav>
                </div>
            </div>
        </div>
    </nav>
    <div class="flex">
        <div class="w-1/5 p-5">
            <div>
                <p>Logo or any other content</p>
            </div>
        </div>           
    @endauth
    <div class="container mx-auto caret-transparent">
        <div class="w-4/5 ml-10">
            @yield('content')
        </div>
    </div>
</body>
</html>
