<form action="{{ route('logout') }}" method="post">
    @csrf
    <button class="text-white cursor-pointer">
        <i class="fa fa-sign-out"></i> Logout
    </button>

</form>
