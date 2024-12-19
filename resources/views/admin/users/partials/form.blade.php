<x-alert/>

@csrf()
<input type="text" name="name" placeholder="name" value="{{ $user->name ?? old('name')}}">
<input type="email" name="email" placeholder="email" value="{{$user->email ?? old('email')}}">
<input type="password" name="password" placeholder="password"> 
<button type="submit">Enviar</button>

