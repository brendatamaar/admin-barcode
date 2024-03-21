<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar" style="z-index: 9999;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <img src=" {{ asset('img/logo.png') }} " width="150" height="150" class="img-fluid" />

    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ (request()->is('home')) ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-home"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Mutasi
    </div>

    <!-- Nav Item - Pages Collapse Menu -->

    @php
    $activeMutasiTagBin = [
    'mutasi_tag_bin1',
    'mutasi_tag_bin2',
    'mutasi_tag_bin3',
    'mutasi_tag_bin4',
    ];
    $isMutasiTagBin = Request::is($activeMutasiTagBin);
    @endphp

    <li class="nav-item {{ $isMutasiTagBin ? 'active' : null }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTagBin" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Mutasi Barcode Lokasi</span>
        </a>

        <div id="collapseTagBin" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['view mutasi-tag-bin1'])
                <a class="collapse-item" href="{{ route('mutasi_tag_bin1.index') }}">Mutasi Barcode Lokasi 1</a>
                @endcanany
                @canany(['view mutasi-tag-bin2'])
                <a class="collapse-item" href="{{ route('mutasi_tag_bin2.index') }}">Mutasi Barcode Lokasi 2</a>
                @endcanany
                @canany(['view mutasi-tag-bin3'])
                <a class="collapse-item" href="{{ route('mutasi_tag_bin3.index') }}">Mutasi Barcode Lokasi 3</a>
                @endcanany
                @canany(['view mutasi-tag-bin4'])
                <a class="collapse-item" href="{{ route('mutasi_tag_bin4.index') }}">Mutasi Barcode Lokasi 4</a>
                @endcanany
            </div>
        </div>
    </li>

    @php
    $activeMutasiCW = [
    'mutasi_cw1',
    'mutasi_cw2',
    'mutasi_cw3',
    'mutasi_cw4',
    'mutasi_cw5',
    ];
    $isMutasiCW = Request::is($activeMutasiCW);
    @endphp

    <li class="nav-item {{ $isMutasiCW ? 'active' : null }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCW" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Mutasi WTB</span>
        </a>
        <div id="collapseCW" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['view mutasi-cw1'])
                <a class="collapse-item" href="{{ route('mutasi_cw1.index') }}">Mutasi WTB 1</a>
                @endcanany
                @canany(['view mutasi-cw2'])
                <a class="collapse-item" href="{{ route('mutasi_cw2.index') }}">Mutasi WTB 2</a>
                @endcanany
                @canany(['view mutasi-cw3'])
                <a class="collapse-item" href="{{ route('mutasi_cw3.index') }}">Mutasi WTB 3</a>
                @endcanany
                @canany(['view mutasi-cw4'])
                <a class="collapse-item" href="{{ route('mutasi_cw4.index') }}">Mutasi WTB 4</a>
                @endcanany
                @canany(['view mutasi-cw5'])
                <a class="collapse-item" href="{{ route('mutasi_cw5.index') }}">Mutasi WTB 5</a>
                @endcanany
            </div>
        </div>
    </li>

    @php
    $activeMutasiD = [
    'mutasi_d1',
    'mutasi_d2',
    'mutasi_d3',
    'mutasi_d4',
    ];
    $isMutasiD = Request::is($activeMutasiD);
    @endphp

    <li class="nav-item {{ $isMutasiD ? 'active' : null }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseD" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-book"></i>
            <span>Mutasi D</span>
        </a>
        <div id="collapseD" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['view mutasi-d1'])
                <a class="collapse-item" href="{{ route('mutasi_d1.index') }}">Mutasi D 1</a>
                @endcanany
                @canany(['view mutasi-d2'])
                <a class="collapse-item" href="{{ route('mutasi_d2.index') }}">Mutasi D 2</a>
                @endcanany
                @canany(['view mutasi-d3'])
                <a class="collapse-item" href="{{ route('mutasi_d3.index') }}">Mutasi D 3</a>
                @endcanany
                @canany(['view mutasi-d4'])
                <a class="collapse-item" href="{{ route('mutasi_d4.index') }}">Mutasi D 4</a>
                @endcanany
            </div>
        </div>
    </li>

    @php
    $activeCR = [
    'crystal_report1',
    'crystal_report2',
    'crystal_report3',
    'crystal_report4',
    ];
    $isCR = Request::is($activeCR);
    @endphp

    <li class="nav-item {{ $isCR ? 'active' : null }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCrystalReport" aria-expanded="true" aria-controls="collapseCrystalReport">
            <i class="fas fa-fw fa-book"></i>
            <span>CR</span>
        </a>
        <div id="collapseCrystalReport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @canany(['view crystal-report1'])
                <a class="collapse-item" href="{{ route('crystal_report1.index') }}">CR 1</a>
                @endcanany
                @canany(['view crystal-report2'])
                <a class="collapse-item" href="{{ route('crystal_report2.index') }}">CR 2</a>
                @endcanany
                @canany(['view crystal-report3'])
                <a class="collapse-item" href="{{ route('crystal_report3.index') }}">CR 3</a>
                @endcanany
                @canany(['view crystal-report4'])
                <a class="collapse-item" href="{{ route('crystal_report4.index') }}">CR 4</a>
                @endcanany
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @canany(['create-user', 'edit-user', 'delete-user'])
    <li class="nav-item {{ (request()->is('users')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>Manage User</span></a>
    </li>
    @endcanany

    @canany(['create-role', 'edit-role', 'delete-role'])
    <li class="nav-item {{ (request()->is('roles')) ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('roles.index') }}">
            <i class="fas fa-fw fa-lock"></i>
            <span>Manage Role</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    @endcanany

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->