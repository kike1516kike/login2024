
<a class="nav-link active" aria-current="page" href="/">Inicio</a>
@guest
<a class="nav-link" href="/login">Login</a>
@else
<a class="nav-link" href="/dashboard">Dashboard</a>
<form style="display: inline;" action="/logout" method="POST">
    @csrf
    <a class="nav-link" href="#" onclick="this.closest('form').submit()">Logout</a>
</form>
@endguest


@if (session('status'))
    <br>
    {{ session('status') }}
@endif
