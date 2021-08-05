 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Drink Manager</div>
    </a>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.html">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de Bord</span></a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">
    <!-- Utilisateurs -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Utilisateurs</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{route('admin.users')}}">Liste</a>
                <a class="collapse-item" href="{{route('admin.users.create')}}">Ajouter</a>
                <h6 class="collapse-header">Roles</h6>
                <a class="collapse-item" href="{{route('admin.roles')}}">Liste</a>
                <a class="collapse-item" href="{{route('admin.roles.create')}}">Ajouter</a>
                <h6 class="collapse-header">Permissions</h6>
                <a class="collapse-item" href="{{route('admin.permissions')}}">Liste</a>
                <a class="collapse-item" href="{{route('admin.permissions.create')}}">Ajouter</a>
            </div>
        </div>
    </li>
    <!-- Boissons -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#boissons"
            aria-expanded="true" aria-controls="boissons">
            <i class="fas fa-fw fa-cog"></i>
            <span>Boissons</span>
        </a>
        <div id="boissons" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="buttons.html">Liste</a>
                <a class="collapse-item" href="cards.html">Ajouter</a>
            </div>
        </div>
    </li>
    <!-- Catégories de Boissons -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories"
            aria-expanded="true" aria-controls="categories">
            <i class="fas fa-fw fa-cog"></i>
            <span>Catégories Boissons</span>
        </a>
        <div id="categories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{route('admin.categories')}}">Liste</a>
                <a class="collapse-item" href="{{route('admin.categories.create')}}">Ajouter</a>
            </div>
        </div>
    </li>
    <!-- Fournisseurs -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#fournisseurs"
            aria-expanded="true" aria-controls="fournisseurs">
            <i class="fas fa-fw fa-cog"></i>
            <span>Fournisseurs</span>
        </a>
        <div id="fournisseurs" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="{{route('admin.fournisseurs')}}">Liste</a>
                <a class="collapse-item" href="{{route('admin.fournisseurs.create')}}">Ajouter</a>
            </div>
        </div>
    </li>
    <!-- Commandes -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#commandes"
            aria-expanded="true" aria-controls="commandes">
            <i class="fas fa-fw fa-cog"></i>
            <span>Commandes Boissons</span>
        </a>
        <div id="commandes" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="buttons.html">Liste</a>
                <a class="collapse-item" href="cards.html">Ajouter</a>
            </div>
        </div>
    </li>
    <!-- Factures -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#factures"
            aria-expanded="true" aria-controls="factures">
            <i class="fas fa-fw fa-cog"></i>
            <span>Factures</span>
        </a>
        <div id="factures" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                <a class="collapse-item" href="buttons.html">Liste</a>
                <a class="collapse-item" href="cards.html">Ajouter</a>
            </div>
        </div>
    </li>
</ul>
