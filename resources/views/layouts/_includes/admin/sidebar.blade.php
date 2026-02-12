<nav class="nxl-navigation">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="{{ route('admin.dashboard') }}" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ asset('images/infosi/infosiLogo.png') }}" alt="INFOSI RH Logo" width="200" class="logo logo-lg" />
                <img src="{{ asset('assets/images/infosiFavicon.png')}}" alt="" class="logo logo-sm" />
            </a>
        </div>
        <div class="navbar-content">
            <ul class="nxl-navbar">
                @if (Auth::check())
                    @php 
                        $role = Auth::user()->role ?? null; 
                        $hasRhMenu = false;
                        if (in_array($role, ['department_head', 'employee']) && Auth::user()->department) {
                            $deptTitle = Str::lower(Auth::user()->department->title);
                            if (Str::contains($deptTitle, ['recursos humanos', 'rh', 'administrativa', 'administração e serviços gerais', 'dasg']) || Str::contains(Auth::user()->department->title, ['DASG'])) {
                                $hasRhMenu = true;
                            }
                        }
                    @endphp

                    <!-- Painel -->
                    <li class="nxl-item nxl-caption">
                        <label>Painel</label>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a class="nxl-link" href="{{ route('admin.dashboard') }}"><i
                                class="fas fa-tachometer-alt me-2"></i>
                            Painel de Controle</a>
                    </li>
                    <li class="nxl-item nxl-hasmenu">
                        <a class="nxl-link" href="{{ route('frontend.index') }}" target="_blank"><i
                                class="fas fa-globe me-2"></i> SITE</a>
                    </li>

                    @if ($role === 'admin' || $role === 'hr')
                        <!-- Estrutura Organizacional -->

                        <li class="nxl-item nxl-caption">
                            <label>Estrutura Organizacional</label>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-columns"></i></span>
                                <span class="nxl-mtext">Departamentos </span> <span class="nxl-arrow"><i
                                        class="fas fa-chevron-right"></span></i>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.departments.index') }}"><i class="fas fa-eye me-2"></i>
                                        Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.departments.create') }}"><i class="fas fa-plus me-2"></i>
                                        Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-briefcase me-2"></i> </span>
                                <span class="nxl-mtext">Cargos</span> <span class="nxl-arrow"><i
                                        class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.positions.index') }}"><i
                                            class="fas fa-eye me-2"></i> Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.positions.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-tag me-2"></i> </span>
                                <span class="nxl-mtext">Função</span> <span class="nxl-arrow"><i
                                        class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.roles.index') }}"><i
                                            class="fas fa-eye me-2"></i> Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.roles.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-star me-2"></i> </span>
                                <span class="nxl-mtext">Especialidades</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.specialties.index') }}"><i class="fas fa-eye me-2"></i>
                                        Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.specialties.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-id-badge me-2"></i></span>
                                <span class="nxl-mtext">Vínculo</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeeTypes.index') }}"><i
                                            class="fas fa-eye me-2"></i> Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeeTypes.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-tags me-2"></i></span>
                                <span class="nxl-mtext">Categorias</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>

                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeeCategories.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todas</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeeCategories.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Nova</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-book-open me-2"></i></span>
                                <span class="nxl-mtext">Cursos</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.courses.index') }}"><i class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.courses.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Gestão de Pessoas -->
                        <li class="nxl-item nxl-caption">
                            <label>Gestão de Pessoas</label>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-users me-2"></i></span>
                                <span class="nxl-mtext">Funcionários</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeee.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeee.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-graduate me-2"></i></span>
                                <span class="nxl-mtext">Estagiários</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.interns.index') }}"><i class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.interns.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-check me-2"></i></span>
                                <span class="nxl-mtext">Reforma</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.retirements.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.retirements.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fa-solid fa-money-check-dollar me-2"></i></span>
                                <span class="nxl-mtext">Salário</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.salaryPayments.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.salaryPayments.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-briefcase me-2"></i></span>
                                <span class="nxl-mtext">Trabalhos Extras</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.extras.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.extras.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-umbrella-beach me-2"></i></span>
                                <span class="nxl-mtext">Pedido de Férias</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.departmentSummary') }}">Férias
                                        por Departamento</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Licenças e Movimentações -->
                        <li class="nxl-item nxl-caption">
                            <label>Licenças e Movimentações</label>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-file-contract me-2"></i></span>
                                <span class="nxl-mtext">Tipos de Licença</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>

                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.leaveTypes.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.leaveTypes.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-file-alt me-2"></i></span>
                                <span class="nxl-mtext">Pedidos de Licença </span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.leaveRequests.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.leaveRequests.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-exchange-alt me-2"></i></span>
                                <span class="nxl-mtext">Mobilidade</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.mobilities.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.mobilities.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fa-solid fa-users-rays me-2"></i></span>
                                <span class="nxl-mtext">Destacamento</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ url('secondment') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ url('secondment/create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Administração e Controle -->
                        <li class="nxl-item nxl-caption">
                            <label>Administração e Controle</label>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fa-solid fa-calendar-check me-2"></i></span>
                                <span class="nxl-mtext">Mapa de Efetividade</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('attendance.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Registros</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('attendance.create') }}"><i
                                            class="fas fa-plus me-2"></i>Registrar Presença</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('attendance.dashboard') }}"><i
                                            class="fa-solid fa-table-columns me-2"></i>Dashboard de Efetividade</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-tie me-2"></i></span>
                                <span class="nxl-mtext">Portal do Chefe Dept.</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dh.myEmployees') }}"><i
                                            class="fa-solid fa-users me-2"></i>Meus Funcionários</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('dh.pendingVacations') }}"><i
                                            class="fas fa-umbrella-beach me-2"></i>Férias Pendentes</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('dh.pendingLeaves') }}"><i
                                            class="fas fa-file-alt me-2"></i>Licenças Pendentes</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('dh.pendingRetirements') }}"><i
                                            class="fas fa-user-clock me-2"></i>Pedidos de Reforma</a></li>
                            </ul>
                        </li>

                        {{-- Módulo de fornecedor (Material) --}}
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-box me-2"></i></span>
                                <span class="nxl-mtext">Fornecedor</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.suppliers.index') }}"><i class="fas fa-eye me-2"></i>
                                        Lista</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.suppliers.create') }}"><i
                                            class="fas fa-plus me-2"></i> Novo</a></li>
                            </ul>
                        </li>

                        {{-- Módulo de Infraestrutura (Material) --}}
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-tools me-2"></i></span>
                                <span class="nxl-mtext">Infraestrutura</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.infrastructures.index') }}"><i
                                            class="fas fa-eye me-2"></i> Lista</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.infrastructures.create') }}"><i
                                            class="fas fa-sign-in-alt me-2"></i> Registrar Entrada</a></li>
                                {{-- <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.infrastructures.materialInput') }}"><i
                                        class="fas fa-sign-in-alt me-2"></i> Registrar Entrada</a></li> --}}
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.infrastructures.materialOutput') }}"><i
                                            class="fas fa-sign-out-alt me-2"></i> Registrar Saída</a></li>
                            </ul>
                        </li>

                        {{-- Módulo de Património (Heritage) --}}
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-building me-2"></i></span>
                                <span class="nxl-mtext">Património</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                {{-- <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.heritages.index') }}"><i
                                        class="fas fa-box me-2"></i> Patrimónios</a></li> --}}
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.heritageTypes.index') }}"><i
                                            class="fas fa-tags me-2"></i> Categoria de Património</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.heritages.index') }}"><i class="fas fa-eye me-2"></i>
                                        Lista</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.heritages.create') }}"><i
                                            class="fas fa-sign-in-alt me-2"></i> Registrar Entrada</a></li>
                                {{-- <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.heritages.materialInput') }}"><i
                                        class="fas fa-sign-in-alt me-2"></i> Registrar Entrada</a></li> --}}
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.heritages.materialOutput') }}"><i
                                            class="fas fa-sign-out-alt me-2"></i> Registrar Saída</a></li>
                                {{-- ROTAS DE TRANSAÇÃO (Histórico, Entrada, Saída) REMOVIDAS --}}
                            </ul>
                        </li>

                        <!-- Frota e Transporte -->
                        <li class="nxl-item nxl-caption">
                            <label>Frota e Transporte</label>
                        </li>

                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-truck me-2"></i></span>
                                <span class="nxl-mtext">Veículos</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vehicles.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vehicles.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-tie me-2"></i></span>
                                <span class="nxl-mtext">Atribuir Meios</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.resourceAssignments.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.resourceAssignments.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-tools me-2"></i></span>
                                <span class="nxl-mtext">Manutenção</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.maintenances.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.maintenances.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Geral -->
                        <li class="nxl-item nxl-caption">
                            <label>Geral</label>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-file-alt me-2"></i></span>
                                <span class="nxl-mtext">Estatuto</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.statutes.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.statutes.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-users-cog me-2"></i></span>
                                <span class="nxl-mtext">Usuários</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.users.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.users.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                    @elseif($role === 'director')
                        <!-- Estrutura Organizacional -->
                        <li class="nxl-item nxl-caption">
                            <label>Estrutura Organizacional</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-columns"></i></span>
                                <span class="nxl-mtext">Departamentos</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.departments.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.departments.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-briefcase"></i></span>
                                <span class="nxl-mtext">Cargos</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.positions.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.positions.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-star"></i></span>
                                <span class="nxl-mtext">Especialidades</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.specialties.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.specialties.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Gestão de Pessoas -->
                        <li class="nxl-item nxl-caption">
                            <label>Gestão de Pessoas</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="{{ route('internEvaluation.index') }}"><i
                                    class="fas fa-clipboard-check me-2"></i> <span class="nxl-mtext">Avaliações de Estagiários</span></a>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-users"></i></span>
                                <span class="nxl-mtext">Funcionários</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeee.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.employeee.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-umbrella-beach"></i></span>
                                <span class="nxl-mtext">Pedido de Férias</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.departmentSummary') }}">Férias
                                        por Departamento</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.vacationRequests.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Licenças e Movimentações -->
                        <li class="nxl-item nxl-hasmenu"
                            style="color: #6c757d; font-weight: bold; padding: 10px 15px;">Licenças e
                            Movimentações</li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);" data-bs-target="#collapseLeaveRequest"
                                aria-expanded="false" aria-controls="collapseLeaveRequest">
                                <i class="fas fa-file-alt me-2"></i> Pedidos de Licença <i
                                    class="fas fa-chevron-right"></i>
                            </a>
                            <div class="collapse" id="collapseLeaveRequest">
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ route('admin.leaveRequests.index') }}"><i
                                                class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ route('admin.leaveRequests.create') }}"><i
                                                class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);" data-bs-target="#collapseMobility"
                                aria-expanded="false" aria-controls="collapseMobility">
                                <i class="fas fa-exchange-alt me-2"></i> Mobilidade <i
                                    class="fas fa-chevron-right"></i>
                            </a>
                            <div class="collapse" id="collapseMobility">
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ route('admin.mobilities.index') }}"><i
                                                class="fas fa-eye me-2"></i>Ver
                                            Todos</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ route('admin.mobilities.create') }}"><i
                                                class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);" data-bs-target="#collapseSecondment"
                                aria-expanded="false" aria-controls="collapseSecondment">
                                <i class="fa-solid fa-users-rays me-2"></i> Destacamento <i
                                    class="fas fa-chevron-right"></i>
                            </a>
                            <div class="collapse" id="collapseSecondment">
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link" href="{{ url('secondment') }}"><i
                                                class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ url('secondment/create') }}"><i
                                                class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- Administração e Controle -->
                        <li class="nxl-item nxl-hasmenu"
                            style="color: #6c757d; font-weight: bold; padding: 10px 15px;">
                            Administração
                            e
                            Controle</li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);" data-bs-target="#deptHeadMenu"
                                aria-expanded="false" aria-controls="deptHeadMenu">
                                <i class="fas fa-user-tie me-2"></i> Portal do Chefe Dept. <i
                                    class="fas fa-chevron-right"></i>
                            </a>
                            <div class="collapse" id="deptHeadMenu">
                                <ul class="nxl-submenu">
                                    <li class="nxl-item"><a class="nxl-link" href="{{ route('dh.myEmployees') }}"><i
                                                class="fa-solid fa-users me-2"></i>Meus Funcionários</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ route('dh.pendingVacations') }}"><i
                                                class="fas fa-umbrella-beach me-2"></i>Férias Pendentes</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ route('dh.pendingLeaves') }}"><i
                                                class="fas fa-file-alt me-2"></i>Licenças Pendentes</a></li>
                                    <li class="nxl-item"><a class="nxl-link"
                                            href="{{ route('dh.pendingRetirements') }}"><i
                                                class="fas fa-user-clock me-2"></i>Pedidos de Reforma</a></li>
                                </ul>
                            </div>
                        </li>

                        <!-- Área Administrativa (RH) -->
                        <li class="nxl-item nxl-caption">
                            <label>Área Administrativa (RH)</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-cog"></i></span>
                                <span class="nxl-mtext">Gestão RH</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.hr.pendingVacations') }}"><i
                                            class="fas fa-umbrella-beach me-2"></i>Férias para Encaminhar</a></li>
                            </ul>
                        </li>

                        <!-- Direção Geral -->
                        <li class="nxl-item nxl-hasmenu"
                            style="color: #6c757d; font-weight: bold; padding: 10px 15px;">Direção
                            Geral
                        </li>
                        <li class="nav-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-tie"></i></span>
                                <span class="nxl-mtext">Portal Direção</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.director.pendingVacations') }}"><i
                                            class="fas fa-check-double me-2"></i>Aprovação de Férias</a></li>
                            </ul>
                        </li>
                    @elseif($role === 'department_head')
                        <!-- Gestão de Pessoas -->
                        <li class="nxl-item nxl-caption">
                            <label>Gestão de Pessoas</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-umbrella-beach"></i></span>
                                <span class="nxl-mtext">Pedido de Férias</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.departmentSummary') }}">Férias
                                        por Departamento</a></li>
                                <li class="nxl-item"><a class="nxl-link" href="{{ route('admin.vacationRequests.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-star"></i></span>
                                <span class="nxl-mtext">Avaliações Funcionários</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('employeeEvaluations.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('employeeEvaluations.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-clipboard-check"></i></span>
                                <span class="nxl-mtext">Avaliações de Estagiários</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('internEvaluation.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('internEvaluation.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Licenças e Movimentações -->
                        <li class="nxl-item nxl-caption">
                            <label>Licenças e Movimentações</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-file-alt"></i></span>
                                <span class="nxl-mtext">Pedidos de Licença</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.leaveRequests.index') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.leaveRequests.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Administração e Controle -->
                        <li class="nxl-item nxl-caption">
                            <label>Administração e Controle</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-tie"></i></span>
                                <span class="nxl-mtext">Portal do Chefe Dept.</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('dh.myEmployees') }}"><i class="fa-solid fa-users me-2"></i>Meus
                                        Funcionários</a>
                                </li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('dh.pendingVacations') }}"><i class="fas fa-umbrella-beach me-2"></i>Férias
                                        Pendentes</a>
                                </li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('dh.pendingLeaves') }}"><i class="fas fa-file-alt me-2"></i>Licenças
                                        Pendentes</a>
                                </li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('dh.pendingRetirements') }}"><i class="fas fa-user-clock me-2"></i>Pedidos de
                                        Reforma</a></li>
                            </ul>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-calendar-check"></i></span>
                                <span class="nxl-mtext">Mapa de Efetividade</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('attendance.index') }}"><i class="fas fa-eye me-2"></i>
                                        Ver Registros</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('attendance.create') }}"><i
                                            class="fas fa-plus me-2"></i>Registrar Presença</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('attendance.dashboard') }}"><i
                                            class="fa-solid fa-table-columns me-2"></i>Dashboard de Efetividade</a>
                                </li>
                            </ul>
                        </li>

                        @if($hasRhMenu)
                        <!-- Área Administrativa (RH) -->
                        <li class="nxl-item nxl-caption">
                            <label>Área Administrativa (RH)</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-cog"></i></span>
                                <span class="nxl-mtext">Gestão RH</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.hr.pendingVacations') }}"><i
                                            class="fas fa-umbrella-beach me-2"></i>Férias para Encaminhar</a></li>
                            </ul>
                        </li>
                        @endif

                    @elseif($role === 'employee')
                        <!-- Gestão de Pessoas -->
                        <li class="nxl-item nxl-caption">
                            <label>Gestão de Pessoas</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-umbrella-beach"></i></span>
                                <span class="nxl-mtext">Pedido de Férias</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.index') }}"><i class="fas fa-eye me-2"></i>Ver
                                        Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ route('admin.vacationRequests.create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-user-check"></i></span>
                                <span class="nxl-mtext">Reforma</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ url('retirements') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ url('retirements/create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>

                        <!-- Licenças e Movimentações -->
                        <li class="nxl-item nxl-caption">
                            <label>Licenças e Movimentações</label>
                        </li>
                        <li class="nxl-item nxl-hasmenu">
                            <a class="nxl-link" href="javascript:void(0);">
                                <span class="nxl-micon"><i class="fas fa-file-alt"></i></span>
                                <span class="nxl-mtext">Pedidos de Licença</span>
                                <span class="nxl-arrow"><i class="fas fa-chevron-right"></i></span>
                            </a>
                            <ul class="nxl-submenu">
                                <li class="nxl-item"><a class="nxl-link" href="{{ url('leaveRequest') }}"><i
                                            class="fas fa-eye me-2"></i>Ver Todos</a></li>
                                <li class="nxl-item"><a class="nxl-link"
                                        href="{{ url('leaveRequest/create') }}"><i
                                            class="fas fa-plus me-2"></i>Adicionar Novo</a></li>
                            </ul>
                        </li>
                    @endif
                <li class="nxl-item nxl-hasmenu">
                    <a class="nxl-link" href="{{ route('profile') }}"><i
                            class="fas fa-user me-2"></i>Meu Perfil</a>
                </li>
                <li class="nxl-item nxl-hasmenu">
                    <a class="nxl-link" href="{{ route('new-chat.index') }}"><i
                            class="fas fa-comments me-2"></i>Chat</a>
                </li>
                @endif
            </ul>
        </div>

    </div>
</nav>