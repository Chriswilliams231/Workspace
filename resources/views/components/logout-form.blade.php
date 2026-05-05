<form action="{{ route('logout') }}" method="post">
    @csrf
    <button class="text-white">
        <i class="fa fa-sign-out"></i> Logout
    </button>

</form>
