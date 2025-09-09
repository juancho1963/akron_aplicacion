<div class="sidebar border-right col-md-3 col-lg-2 p-0 bg-body-tertiary" data-bs-theme="dark">
    <div class="offcanvas-md offcanvas-end bg-body-tertiary vh-100" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title text-white" id="sidebarMenuLabel">Aplicacion AKRON</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2" aria-current="page" href="{{ route('admin.index')}}">
                        <i class="fas fa-dashboard"></i>
                        Panel Administrativo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2" aria-current="page" href="">
                        <i class="fas fa-palette"></i>
                       Clientes
                    </a>
                </li>
                                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2" aria-current="page" href="{{ route('admin.cupons.index')}}">
                        <i class="fas fa-expand"></i>
                       Cupones
                    </a>
                </li>
               <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2" aria-current="page" href="{{ route('admin.marcas.index')}}">
                        <i class="fas fa-ticket"></i>
                       Marcas
                    </a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2" aria-current="page" href="{{ route('admin.produs.index')}}">
                        <i class="fas fa-tags"></i>
                       Productos
                    </a>
                </li>
            </ul>
            <hr class="my-3">
            <ul class="nav flex-column mb-auto">
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2"
                    onclick="document.getElementById('AdminLogoutForm').submit()" href="#">
                        <svg class="bi">
                            <use xlink:href="#door-closed" />
                        </svg>
                        Cerrar sesión
                    </a>
                    <form id="AdminLogoutForm" action="{{ route('admin.logout')}}" method="POST">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
