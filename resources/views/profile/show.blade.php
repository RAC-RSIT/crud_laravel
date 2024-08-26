<!DOCTYPE html>
<html>
<head>
    <title>{{ $user->name }}'s Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body>
        <h1>{{ $user->name }}'s Profile</h1>
        <p><strong>Email:</strong> {{ $user->email }}</p>

        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="Profile Picture">

        

        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"">
            <a href="{{route('profile.edit')}}">Edit profile</a>
        </button> 
    </body>
</html>