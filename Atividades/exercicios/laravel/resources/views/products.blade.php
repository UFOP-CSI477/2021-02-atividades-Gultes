<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <p class="text-2xl font-extrabold leading-6 text-gray-800 justify-center text-center my-8">Produtos</p>

    <div class="flex flex-col m-8">
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-4 inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-center rounded">
                        <thead class="border-b bg-gray-800">
                            <tr>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">ID</th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">Nome</th>
                                <th scope="col" class="text-sm font-medium text-white px-6 py-4">Um</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $product->id }}</td>
                                <td class="text-sm text-gray-900 font-regular px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                                <td class="text-sm text-gray-900 font-regular px-6 py-4 whitespace-nowrap">{{ $product->um }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>