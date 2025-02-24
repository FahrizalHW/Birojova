<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex justify-center items-center h-screen bg-gray-100">
    <form action="{{ route('admin.login') }}" method="POST" class="bg-white p-6 rounded shadow-md w-80">
        @csrf
        <h2 class="text-xl font-bold mb-4">Login Admin</h2>
        <div>
            <label class="block">Email</label>
            <input type="email" name="email" class="w-full p-2 border rounded" required>
        </div>
        <div class="mt-4">
            <label class="block">Password</label>
            <input type="password" name="password" class="w-full p-2 border rounded" required>
        </div>
        @if ($errors->any())
            <p class="text-red-500 text-sm mt-2">{{ $errors->first() }}</p>
        @endif
        <div class="mt-4 flex justify-between gap-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 flex-1">Login</button>
            <a href="/" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-center flex-1">Cancel</a>
        </div>
    </form>
</body>
</html> 