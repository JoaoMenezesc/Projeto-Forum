<x-alert/>

@csrf()
<label for="title" class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Título: </label>
<input type="text" name="title" id="title"> 
<br>
<label for="content" class="text-2xl font-bold mb-4 text-gray-800 dark:text-gray-100">Escreva seu recado!</label>
<br>
<textarea name="content" id="content" cols="50" rows="10" required></textarea>
<br>
<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enviar</button>

