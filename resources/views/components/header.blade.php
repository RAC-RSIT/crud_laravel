<div style="background-color:rgb(224, 165, 158)">
    <a href="{{ route('dashboard') }}" class="nav-link text-dark">Dashboard</a>
    <form action="{{ route('logout') }}" method="POST">
        @csrf 
        @method('POST')
        <input type="submit" value="Logout" class="nav-link text-dark">
    </form>
</div>