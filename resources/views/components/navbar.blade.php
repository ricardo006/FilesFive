<div class="navbar">
    <h1>FileFive</h1>
    <form action="{{ route('logout') }}" method="POST" id="logout-form">
        @csrf
        <button type="button" onclick="event.preventDefault(); this.closest('form').submit();" class="btn-logout">
            Logout
            <i data-feather="log-out" class="feather-18"></i>
        </button>
    </form>
</div>