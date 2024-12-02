<div class="navbar">
    <a class="title-app" href="{{ route('dashboard') }}">
        <h1 >FileFive</h1>
    </a>
    <form action="{{ route('logout') }}" method="POST" id="logout-form">
        @csrf
        <div class="button-container-navbar">
            <button class="btn-user" type="button" id="usernamenavbar" class="usernamenavbar">
                {{ session('userName', 'Usuário') }}
            </button>

            <button class="btn-logout" type="button" onclick="event.preventDefault(); this.closest('form').submit();" >
                Sair
                <i data-feather="log-out" class="feather-18"></i>
            </button>
        </div>
    </form>
</div>

<div class="modal-overlay" id="modalOverlay">
    <div class="modal">
        <div class="modal-header">
            <div class="close-container">
                <i data-feather="x-circle"></i>
            </div>
            <div class="infos-modal">
                <p><span id="modalUserName"></span></p>
                <p><span id="modalUserEmail"></span></p>
            </div>
        </div>
        <div class="modal-content" id="modalContent">
            <div class="modal-body">
                <ul class="user-options">
                    <li>
                        <a href="{{ route('settings') }}">
                            <i data-feather="settings"></i>
                            <span>Configurações</span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('account') }}">
                            <i data-feather="user"></i>
                            <span>Minha Conta</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const storedUserName = localStorage.getItem('userName') || 'Usuário';
        const storedUserEmail = localStorage.getItem('userEmail') || 'email@exemplo.com';

        const modalOverlay = document.getElementById('modalOverlay');
        const modalContent = document.getElementById('modalContent');
        const closeContainer = document.querySelector(".close-container");

        const modalUserName = document.getElementById('modalUserName');
        const modalUserEmail = document.getElementById('modalUserEmail');

        const userNameNavBar = document.getElementById('usernamenavbar');

        if (userNameNavBar) {
            userNameNavBar.textContent = storedUserName;
        }

        modalUserName.textContent = storedUserName;
        modalUserEmail.textContent = storedUserEmail;

        closeContainer.addEventListener("click", function () {
            modalOverlay.style.display = 'none';
        });

        document.getElementById('usernamenavbar').addEventListener('click', function() {
            const button = event.target;
            const rect = button.getBoundingClientRect();
            const modalHeight = modalContent.offsetHeight;

            modalContent.style.top = `${rect.bottom + window.scrollY}px`;
            modalContent.style.left = `${rect.left + window.scrollX}px`;
            
            modalOverlay.style.display = 'block';
        });

        modalOverlay.addEventListener('click', function(event) {
            if (event.target === modalOverlay) {
                modalOverlay.style.display = 'none';
            }
        });
    });
</script>

