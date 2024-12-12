<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travigo</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex flex-col gap-4">
    <header>
         
    </header>

    <div class="bg-blue-50 w-72 m-auto p-5 rounded-lg">
            <form id="form" class="flex flex-col gap-1">
                <div class="flex flex-col gap-1">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" placeholder="Enter your name" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="email">Email:</label>
                    <input type="email" id="eamil" name="email" placeholder="Enter your email" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
                <div class="flex flex-col gap-1">
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" class="bg-gray-50 border border-blue-300 text-gray-900 text-sm rounded-lg p-2.5 focus:outline-none focus:ring focus:ring-blue-400">
                </div>
            </form>
            <button type="submit" id="save" class="mt-4 bg-blue-200 w-full text-white hover:bg-blue-400 py-2 rounded-md">Save</button>
            <button id="cancel" class="mt-4 bg-red-200 w-full text-white hover:bg-red-400 py-2 rounded-md">Cancel</button>
        </div>

    <footer>
        
    </footer>

</body>
</html>



<?php


?>