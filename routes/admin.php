<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\CourseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeeController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\EmployeeCategoryController;
use App\Http\Controllers\Admin\InternController;
use App\Http\Controllers\Admin\RetirementController;
use App\Http\Controllers\Admin\VehicleController;
use App\Http\Controllers\Admin\ResourceAssignmentController;
use App\Http\Controllers\Admin\EmployeeHistoryController;
use App\Http\Controllers\Admin\EmployeeTypeController;
use App\Http\Controllers\Admin\ExtraJobController;
use App\Http\Controllers\Admin\HeritageController;
use App\Http\Controllers\Admin\HeritageTypeController;
use App\Http\Controllers\Admin\InfrastructureController;
use App\Http\Controllers\Admin\LeaveRequestController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\LicenseCategoryController;
use App\Http\Controllers\Admin\MaintenanceController;
use App\Http\Controllers\Admin\MobilityController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SalaryPaymentController;
use App\Http\Controllers\Admin\SecondmentController;
use App\Http\Controllers\Admin\SpecialtyController;
use App\Http\Controllers\Admin\StatuteController;
use App\Http\Controllers\Admin\VacationRequestController;
use App\Http\Controllers\Admin\SupplierController;

Route::middleware('auth')->name('admin.')->group(function () {

    /* inicio dashboard routes */
    Route::get('/dashboard/filter-by-category/{categoryId}/{academicLevel?}', [DashboardController::class, 'filterByCategory'])->name('dashboard.filterByCategory');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    /* fim dashboard routes */

    /* inicio department routes */
    Route::prefix('departamentos')->group(function () {

        Route::get('/lista', [DepartmentController::class, 'index'])->name('departments.index');
        Route::get('/criar', [DepartmentController::class, 'create'])->name('departments.create');
        Route::post('/salvar', [DepartmentController::class, 'store'])->name('departments.store');
        Route::get('/editar/{id}', [DepartmentController::class, 'edit'])->name('departments.edit');
        Route::put('/atualizar/{id}', [DepartmentController::class, 'update'])->name('departments.update');
        Route::get('/detalhes/{id}', [DepartmentController::class, 'show'])->name('departments.show');
        Route::get('{id}/delete', [DepartmentController::class, 'destroy'])->name('departments.destroy');

        //outras rotas de departamento
        Route::get('{departmentId}/pdf', [DepartmentController::class, 'employeeePdf'])->name('departments.employeee.pdf');
        Route::get('employeee', [DepartmentController::class, 'employeee'])->name('departments.employeee');
    });
    /* fim department routes */

    // inicio Cargos (Positions) 
    Route::prefix('cargos')->group(function () {

        Route::get('/lista', [PositionController::class, 'index'])->name('positions.index');
        Route::get('/criar', [PositionController::class, 'create'])->name('positions.create');
        Route::post('/salvar', [PositionController::class, 'store'])->name('positions.store');
        Route::get('/editar/{id}', [PositionController::class, 'edit'])->name('positions.edit');
        Route::put('/atualizar/{id}', [PositionController::class, 'update'])->name('positions.update');
        Route::get('/detalhes/{id}', [PositionController::class, 'show'])->name('positions.show');
        Route::get('/{id}/delete', [PositionController::class, 'destroy'])->name('positions.destroy');

        //filtros
        Route::get('/funcionarios', [PositionController::class, 'employeee'])->name('positions.employeee.filter');
        Route::get('/{positionId}/pdf', [PositionController::class, 'pdf'])->name('positions.employeee.pdf');
    });
    // fim Cargos (Positions)

    // inicio funcao (role) 
    Route::prefix('funcao')->group(function () {

        Route::get('/lista', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/criar', [RoleController::class, 'create'])->name('roles.create');
        Route::post('/salvar', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/editar/{id}', [RoleController::class, 'edit'])->name('roles.edit');
        Route::put('/atualizar/{id}', [RoleController::class, 'update'])->name('roles.update');
        Route::get('/detalhes/{id}', [RoleController::class, 'show'])->name('roles.show');
        Route::get('/{id}/delete', [RoleController::class, 'destroy'])->name('roles.destroy');

        //filtros
        Route::get('/funcionarios', [RoleController::class, 'employeee'])->name('roles.employeee.filter');
        Route::get('/{positionId}/pdf', [RoleController::class, 'pdf'])->name('roles.employeee.pdf');
    });
    // fim funcao (role)

    // inicio Especialidades (Specialties) routes
    Route::prefix('especialidades')->group(function () {

        Route::get('/lista', [SpecialtyController::class, 'index'])->name('specialties.index');
        Route::get('/criar', [SpecialtyController::class, 'create'])->name('specialties.create');
        Route::post('/salvar', [SpecialtyController::class, 'store'])->name('specialties.store');
        Route::get('/editar/{id}', [SpecialtyController::class, 'edit'])->name('specialties.edit');
        Route::put('/atualizar/{id}', [SpecialtyController::class, 'update'])->name('specialties.update');
        Route::get('/detalhes/{id}', [SpecialtyController::class, 'show'])->name('specialties.show');
        Route::get('specialties/{id}/delete', [SpecialtyController::class, 'destroy'])->name('specialties.destroy');

        //filtros
        Route::get('specialties/employeee', [SpecialtyController::class, 'employeee'])->name('specialties.employeee.filter');
        Route::get('specialties/{specialtyId}/pdf', [SpecialtyController::class, 'pdf'])->name('specialties.pdf');
    });
    // fim Especialidades (Specialties) routes

    // inicio Rotas Para o Tipo de Funcionário (EmployeeType) 
    Route::prefix('vinculo-funcionario')->group(function () {

        Route::get('/lista', [EmployeeTypeController::class, 'index'])->name('employeeTypes.index');
        Route::get('/criar', [EmployeeTypeController::class, 'create'])->name('employeeTypes.create');
        Route::post('/salvar', [EmployeeTypeController::class, 'store'])->name('employeeTypes.store');
        Route::get('/editar/{id}', [EmployeeTypeController::class, 'edit'])->name('employeeTypes.edit');
        Route::put('/atualizar/{id}', [EmployeeTypeController::class, 'update'])->name('employeeTypes.update');
        Route::get('/detalhes/{id}', [EmployeeTypeController::class, 'show'])->name('employeeTypes.show');
        Route::get('{id}/delete', [EmployeeTypeController::class, 'destroy'])->name('employeeTypes.destroy');
    });
    // fim Rotas Para o Tipo de Funcionário (EmployeeType) 


    // inicio Rotas Para Categoria de Funcionário (EmployeeCategory) 
    Route::prefix('categoria-funcionario')->group(function () {

        Route::get('/lista', [EmployeeCategoryController::class, 'index'])->name('employeeCategories.index');
        Route::get('/criar', [EmployeeCategoryController::class, 'create'])->name('employeeCategories.create');
        Route::post('/salvar', [EmployeeCategoryController::class, 'store'])->name('employeeCategories.store');
        Route::get('/editar/{id}', [EmployeeCategoryController::class, 'edit'])->name('employeeCategories.edit');
        Route::put('/atualizar/{id}', [EmployeeCategoryController::class, 'update'])->name('employeeCategories.update');
        Route::get('/detalhes/{id}', [EmployeeCategoryController::class, 'show'])->name('employeeCategories.show');
        Route::get('{id}/delete', [EmployeeCategoryController::class, 'destroy'])->name('employeeCategories.destroy');
    });
    // fim Rotas Para Categoria de Funcionário (EmployeeCategory) 

    /* inicio course routes */
    Route::prefix('cursos')->group(function () {

        Route::get('/lista', [CourseController::class, 'index'])->name('courses.index');
        Route::get('/criar', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/salvar', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/editar/{id}', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/atualizar/{id}', [CourseController::class, 'update'])->name('courses.update');
        Route::get('/detalhes/{id}', [CourseController::class, 'show'])->name('courses.show');
        Route::get('{id}/delete', [CourseController::class, 'destroy'])->name('courses.destroy');
    });
    /* fim course routes */


    /* inicio Employee routes */
    Route::prefix('funcionarios')->group(function () {

        Route::get('/lista', [EmployeeeController::class, 'index'])->name('employeee.index');
        Route::get('/criar', [EmployeeeController::class, 'create'])->name('employeee.create');
        Route::post('/salvar', [EmployeeeController::class, 'store'])->name('employeee.store');
        Route::get('/editar/{id}', [EmployeeeController::class, 'edit'])->name('employeee.edit');
        Route::put('/atualizar/{id}', [EmployeeeController::class, 'update'])->name('employeee.update');
        Route::get('/detalhes/{id}', [EmployeeeController::class, 'show'])->name('employeee.show');
        Route::delete('/deletar/{id}', [EmployeeeController::class, 'destroy'])->name('employeee.destroy');


        // Histórico do funcionário
        Route::get('/history/{id}', [EmployeeHistoryController::class, 'index'])->name('employeee.history');
        Route::get('/history/{id}/pdf', [EmployeeHistoryController::class, 'employeeHistoryPdf'])->name('employeee.history.pdf');

        // filtros

        /* Rota GET com parâmetro ?status=... */
        Route::get('employeee/filter-by-status', [EmployeeeController::class, 'filterByStatus'])->name('employeee.filterByStatus');
        /* FIm da Rota GET com parâmetro ?status=... */

        Route::get('/navbar/employee-search', [EmployeeeController::class, 'navbarSearch'])->name('employeee.navbar.search');
        Route::get('employeee/pdf', [EmployeeeController::class, 'pdfAll'])->name('employeee.pdfAll');
        Route::get('employeee/{id}/pdf', [EmployeeeController::class, 'showPdf'])->name('employeee.showPdf');
        Route::get('employeee/filter', [EmployeeeController::class, 'filterByDate'])->name('employeee.filter');
        Route::post('employeee/filter/pdf', [EmployeeeController::class, 'pdfFiltered'])->name('employeee.filter.pdf');
    });
    /* fim Employee routes */

    // inicio Estagiários (Intern) routes
    Route::prefix('estagiarios')->group(function () {

        Route::get('/lista', [InternController::class, 'index'])->name('interns.index');
        Route::get('/criar', [InternController::class, 'create'])->name('interns.create');
        Route::post('/salvar', [InternController::class, 'store'])->name('interns.store');
        Route::get('/editar/{id}', [InternController::class, 'edit'])->name('interns.edit');
        Route::put('/atualizar/{id}', [InternController::class, 'update'])->name('intern.update');
        Route::get('/detalhes/{id}', [InternController::class, 'show'])->name('interns.show');
        Route::get('/deletar/{id}', [InternController::class, 'destroy'])->name('interns.destroy');

        /* filtros */
        Route::get('{id}/pdf', [InternController::class, 'showPdf'])->name('interns.showPdf');
        Route::get('pdf', [InternController::class, 'pdfAll'])->name('interns.pdfAll');
        Route::get('filtros', [InternController::class, 'filterByDate'])->name('interns.filter');
        Route::post('filtros/pdf', [InternController::class, 'pdfFiltered'])->name('interns.filter.pdf');
    });
    // fim Estagiários (Intern) routes

    // inicio Reforma (Retirement) routes
    Route::prefix('reformas')->group(function () {

        Route::get('/lista', [RetirementController::class, 'index'])->name('retirements.index');
        Route::get('/criar', [RetirementController::class, 'create'])->name('retirements.create');
        Route::post('/salvar', [RetirementController::class, 'store'])->name('retirements.store');
        Route::get('/editar/{id}', [RetirementController::class, 'edit'])->name('retirements.edit');
        Route::put('/atualizar/{id}', [RetirementController::class, 'update'])->name('retirements.update');
        Route::get('/detalhes/{id}', [RetirementController::class, 'show'])->name('retirements.show');
        Route::delete('/deletar/{id}', [RetirementController::class, 'destroy'])->name('retirements.destroy');

        //filtros
        Route::get('reformas/searchEmployee', [RetirementController::class, 'searchEmployee'])->name('retirements.searchEmployee');
        Route::get('reformas/pdf-filtered', [RetirementController::class, 'pdfAll'])->name('retirements.exportFilteredPDF');
        Route::get('reformas/pdf', [RetirementController::class, 'pdfAll'])->name('retirements.pdf');
    });
    // fim Reforma (Retirement) routes

    // inicio Pagamento de Salário (Salary Payment)
    Route::prefix('pagamento-salario')->group(function () {

        Route::get('/lista', [SalaryPaymentController::class, 'index'])->name('salaryPayments.index');
        Route::get('/criar', [SalaryPaymentController::class, 'create'])->name('salaryPayments.create');
        Route::post('/salvar', [SalaryPaymentController::class, 'store'])->name('salaryPayments.store');
        Route::get('/editar/{id}', [SalaryPaymentController::class, 'edit'])->name('salaryPayments.edit');
        Route::put('/atualizar/{id}', [SalaryPaymentController::class, 'update'])->name('salaryPayments.update');
        Route::get('/detalhes/{id}', [SalaryPaymentController::class, 'show'])->name('salaryPayments.show');
        Route::delete('/deletar/{id}', [SalaryPaymentController::class, 'destroy'])->name('salaryPayments.destroy');

        //filtros
        Route::get('/search-employee-ajax', [SalaryPaymentController::class, 'searchEmployeeAjax'])->name('salaryPayments.searchEmployeeAjax');
        Route::get('/pdf-period', [SalaryPaymentController::class, 'pdfPeriod'])->name('salaryPayments.pdfPeriod');
        Route::get('/pdf-employee/{employeeId}', [SalaryPaymentController::class, 'pdfByEmployee'])->name('salaryPayments.pdfByEmployee');

        Route::get('/searchEmployee', [SalaryPaymentController::class, 'searchEmployee'])->name('salaryPayments.searchEmployee');
        Route::get('/pdf', [SalaryPaymentController::class, 'pdfAll'])->name('salaryPayments.pdfAll');
        Route::get('/calculateDiscount', [SalaryPaymentController::class, 'calculateDiscount'])->name('salaryPayments.calculateDiscount');
    });
    // fim Pagamento de Salário (Salary Payment)

    // inicio Viaturas (vehicles) routes
    Route::prefix('veiculos')->group(function () {

        Route::get('/lista', [VehicleController::class, 'index'])->name('vehicles.index');
        Route::get('/criar', [VehicleController::class, 'create'])->name('vehicles.create');
        Route::post('/salvar', [VehicleController::class, 'store'])->name('vehicles.store');
        Route::get('/editar/{vehicle}', [VehicleController::class, 'edit'])->name('vehicles.edit');
        Route::put('/atualizar/{vehicle}', [VehicleController::class, 'update'])->name('vehicles.update');
        Route::get('/detalhes/{vehicle}', [VehicleController::class, 'show'])->name('vehicles.show');
        Route::get('/deletar/{vehicle}', [VehicleController::class, 'destroy'])->name('vehicles.destroy');

        //filtros
        Route::get('vehicles/{vehicle}/pdf', [VehicleController::class, 'showPdf'])->name('vehicles.showPdf');
        Route::get('pdf', [VehicleController::class, 'pdfAll'])->name('vehicles.pdfAll');
        Route::get('pdf-filtered', [VehicleController::class, 'exportFilteredPDF'])->name('vehicles.pdfFiltered');
    });
    // fim Viaturas (vehicles) routes

    //inicio Atribuições de Recursos (Resource Assignments) routes
    Route::prefix('atribuicoes')->group(function () {

        Route::get('/lista', [ResourceAssignmentController::class, 'index'])->name('resourceAssignments.index');
        Route::get('/criar', [ResourceAssignmentController::class, 'create'])->name('resourceAssignments.create');
        Route::post('/salvar', [ResourceAssignmentController::class, 'store'])->name('resourceAssignments.store');
        Route::get('/editar/{resourceAssignment}', [ResourceAssignmentController::class, 'edit'])->name('resourceAssignments.edit');
        Route::put('/atualizar/{resourceAssignment}', [ResourceAssignmentController::class, 'update'])->name('resourceAssignments.update');
        Route::get('/detalhes/{resourceAssignment}', [ResourceAssignmentController::class, 'show'])->name('resourceAssignments.show');
        Route::get('/deletar/{resourceAssignment}', [ResourceAssignmentController::class, 'destroy'])->name('resourceAssignments.destroy');

        //filtros
        /*  Route::get('pesquisar/funcionario', [ResourceAssignmentController::class, 'searchEmployee'])->name('resourceAssignments.searchEmployee'); */
        Route::get('atribuicoes/{resourceAssignment}/pdf', [ResourceAssignmentController::class, 'showPdf'])->name('resourceAssignments.showPdf');
        Route::get('pdf', [ResourceAssignmentController::class, 'pdfAll'])->name('resourceAssignments.pdfAll');
        Route::get('pdf-filtered', [ResourceAssignmentController::class, 'exportFilteredPDF'])->name('resourceAssignments.pdfFiltered');
    });
    //fim Atribuições de Recursos (Resource Assignments) routes

    // inicio Tipos de Licença (LeaveType) 
    Route::prefix('tipos-licenca')->group(function () {

        Route::get('/lista', [LeaveTypeController::class, 'index'])->name('leaveTypes.index');
        Route::get('/criar', [LeaveTypeController::class, 'create'])->name('leaveTypes.create');
        Route::post('/salvar', [LeaveTypeController::class, 'store'])->name('leaveTypes.store');
        Route::get('/editar/{id}', [LeaveTypeController::class, 'edit'])->name('leaveTypes.edit');
        Route::put('/atualizar/{id}', [LeaveTypeController::class, 'update'])->name('leaveTypes.update');
        Route::get('/detalhes/{id}', [LeaveTypeController::class, 'show'])->name('leaveTypes.show');
        Route::delete('/deletar/{id}', [LeaveTypeController::class, 'destroy'])->name('leaveTypes.destroy');
    });
    // fim Tipos de Licença (LeaveType) 

    // inicio Manutenções (maintenance) routes

    Route::prefix('manutencoes')->group(function () {

        Route::get('/lista', [MaintenanceController::class, 'index'])->name('maintenances.index');
        Route::get('/criar', [MaintenanceController::class, 'create'])->name('maintenances.create');
        Route::post('/salvar', [MaintenanceController::class, 'store'])->name('maintenances.store');
        Route::get('/editar/{id}', [MaintenanceController::class, 'edit'])->name('maintenances.edit');
        Route::put('/atualizar/{id}', [MaintenanceController::class, 'update'])->name('maintenances.update');
        Route::get('/detalhes/{id}', [MaintenanceController::class, 'show'])->name('maintenances.show');
        Route::get('/deletar/{id}', [MaintenanceController::class, 'destroy'])->name('maintenances.destroy');
    });

    //filtros e pdf
    Route::get('maintenance/{maintenance}/pdf', [MaintenanceController::class, 'showPdf'])->name('maintenances.showPdf');
    Route::get('maintenance/pdf', [MaintenanceController::class, 'pdfAll'])->name('maintenances.pdfAll');
    Route::get('maintenance/pdf-filtered', [MaintenanceController::class, 'exportFilteredPDF'])->name('maintenances.pdfFiltered');
    // fim Manutenções (maintenance) routes

    // inicio estatuto (statute) routes
    Route::prefix('estatuto')->group(function () {

        Route::get('/lista', [StatuteController::class, 'index'])->name('statutes.index');
        Route::get('/criar', [StatuteController::class, 'create'])->name('statutes.create');
        Route::post('/salvar', [StatuteController::class, 'store'])->name('statutes.store');
        Route::get('/editar/{id}', [StatuteController::class, 'edit'])->name('statutes.edit');
        Route::put('/atualizar/{id}', [StatuteController::class, 'update'])->name('statutes.update');
        Route::get('/detalhes/{id}', [StatuteController::class, 'show'])->name('statutes.show');
        Route::get('/deletar/{id}', [StatuteController::class, 'destroy'])->name('statutes.destroy');
    });
    // fim estatuto (statute) routes

    // inicio categoria de Património
    Route::prefix('categoria-patrimonio')->group(function () {

        Route::get('/listar', [HeritageTypeController::class, 'index'])->name('heritageTypes.index');
        Route::get('/criar', [HeritageTypeController::class, 'create'])->name('heritageTypes.create');
        Route::post('/salvar', [HeritageTypeController::class, 'store'])->name('heritageTypes.store');
        Route::get('/detalhes/{id}', [HeritageTypeController::class, 'show'])->name('heritageTypes.show');
        Route::get('/editar/{id}/edit', [HeritageTypeController::class, 'edit'])->name('heritageTypes.edit');
        Route::put('/atualizar/{id}', [HeritageTypeController::class, 'update'])->name('heritageTypes.update');
        Route::delete('/apagar/{id}', [HeritageTypeController::class, 'destroy'])->name('heritageTypes.destroy');
    });
    // fim categoria de Património

    // inicio Mobilidade (Mobility)
    Route::prefix('mobilidade')->group(function () {

        Route::get('/listar', [MobilityController::class, 'index'])->name('mobilities.index');
        Route::get('/criar', [MobilityController::class, 'create'])->name('mobilities.create');
        Route::post('/salvar', [MobilityController::class, 'store'])->name('mobilities.store');
        Route::get('/detalhes/{id}', [MobilityController::class, 'show'])->name('mobilities.show');
        Route::get('/editar/{id}/edit', [MobilityController::class, 'edit'])->name('mobilities.edit');
        Route::put('/atualizar/{id}', [MobilityController::class, 'update'])->name('mobilities.update');
        Route::delete('/apagar/{id}', [MobilityController::class, 'destroy'])->name('mobilities.destroy');
    });

    //filtros
    Route::get('/pdf', [MobilityController::class, 'pdfAll'])->name('mobilities.pdfAll');
    Route::get('/search-employee', [MobilityController::class, 'searchEmployee'])->name('mobilities.searchEmployee');
    // fim Mobilidade (Mobility)

    // inicio Destacamento (Secondment)
    Route::prefix('destacamento')->group(function () {

        Route::get('/listar', [SecondmentController::class, 'index'])->name('secondments.index');
        Route::get('/criar', [SecondmentController::class, 'create'])->name('secondments.create');
        Route::post('/salvar', [SecondmentController::class, 'store'])->name('secondments.store');
        Route::get('/detalhes/{id}', [SecondmentController::class, 'show'])->name('secondments.show');
        Route::get('/editar/{id}/edit', [SecondmentController::class, ' edit'])->name('secondments.edit');
        Route::put('/atualizar/{id}', [SecondmentController::class, 'update'])->name('secondments.update');
        Route::delete('/apagar/{id}', [SecondmentController::class, 'destroy'])->name('secondments.destroy');

        //filtros e pdf
        Route::get("secondment/searchEmployee", [SecondmentController::class, "searchEmployee"])->name("secondments.searchEmployee");
        Route::get("secondment/pdf", [SecondmentController::class, "pdfAll"])->name("secondments.pdfAll");
    });
    // fim Destacamento (Secondment)

    // inicio Trabalhos extras(ExtraJobs)
    Route::prefix('trabalhos-extras')->group(function () {

        Route::get('/listar', [ExtraJobController::class, 'index'])->name('extras.index');
        Route::get('/criar', [ExtraJobController::class, 'create'])->name('extras.create');
        Route::post('/salvar', [ExtraJobController::class, 'store'])->name('extras.store');
        Route::get('/detalhes/{id}', [ExtraJobController::class, 'show'])->name('extras.show');
        Route::get('/editar/{id}/edit', [ExtraJobController::class, 'edit'])->name('extras.edit');
        Route::put('/atualizar/{id}', [ExtraJobController::class, 'update'])->name('extras.update');
        Route::delete('/apagar/{id}', [ExtraJobController::class, 'destroy'])->name('extras.destroy');

        //filtros
        Route::get('/pdf', [ExtraJobController::class, 'pdfAll'])->name('extras.pdfAll');
        Route::get('/{id}/pdf', [ExtraJobController::class, 'pdfShow'])->whereNumber('id')->name('extras.pdfShow');
        Route::get('/search-employee', [ExtraJobController::class, 'searchEmployee'])->name('extras.searchEmployee');
    });
    // fim Trabalhos extras(ExtraJobs)

    // inicio categoria de Licença (LeaveRequest) 
    Route::prefix('categoria-licenca')->group(function () {

        Route::get('/listar', [LicenseCategoryController::class, 'index'])->name('licenseCategories.index');
        Route::get('/criar', [LicenseCategoryController::class, 'create'])->name('licenseCategories.create');
        Route::post('/salvar', [LicenseCategoryController::class, 'store'])->name('licenseCategories.store');
        Route::get('/detalhes/{id}', [LicenseCategoryController::class, 'show'])->name('licenseCategories.show');
        Route::get('/editar/{id}/edit', [LicenseCategoryController::class, 'edit'])->name('licenseCategories.edit');
        Route::put('/atualizar/{id}', [LicenseCategoryController::class, 'update'])->name('licenseCategories.update');
        Route::delete('/apagar/{id}', [LicenseCategoryController::class, 'destroy'])->name('licenseCategories.destroy');
    });
    // fim Pedido de Licença (LeaveRequest) 

    // inicio Pedido de Licença (LeaveRequest) 
    Route::prefix('pedido-licenca')->group(function () {

        Route::get('/listar', [LeaveRequestController::class, 'index'])->name('leaveRequests.index');
        Route::get('/criar', [LeaveRequestController::class, 'create'])->name('leaveRequests.create');
        Route::post('/salvar', [LeaveRequestController::class, 'store'])->name('leaveRequests.store');
        Route::get('/detalhes/{id}', [LeaveRequestController::class, 'show'])->name('leaveRequests.show');
        Route::get('/editar/{id}/edit', [LeaveRequestController::class, 'edit'])->name('leaveRequests.edit');
        Route::put('/atualizar/{id}', [LeaveRequestController::class, 'update'])->name('leaveRequests.update');
        Route::delete('/apagar/{id}', [LeaveRequestController::class, 'destroy'])->name('leaveRequests.destroy');

        //filtros
        Route::get('leaveRequest/searchEmployee', [LeaveRequestController::class, 'searchEmployee'])->name('leaveRequests.searchEmployee');
        Route::get('leave-request/pdf-filtered', [LeaveRequestController::class, 'pdfAll'])->name('leaveRequests.exportFilteredPDF');
        Route::get('leaveRequest/pdf', [LeaveRequestController::class, 'pdfAll'])->name('leaveRequests.pdfAll');
    });
    // fim Pedido de Licença (LeaveRequest) 


    // inicio Pedido de Férias (Vacation Request) 
    Route::prefix('pedido-ferias')->group(function () {

        Route::get('/listar', [VacationRequestController::class, 'index'])->name('vacationRequests.index');
        Route::get('/criar', [VacationRequestController::class, 'create'])->name('vacationRequests.create');
        Route::post('/salvar', [VacationRequestController::class, 'store'])->name('vacationRequests.store');
        Route::get('/detalhes/{id}', [VacationRequestController::class, 'show'])->name('vacationRequests.show');
        Route::get('/editar/{id}/edit', [VacationRequestController::class, 'edit'])->name('vacationRequests.edit');
        Route::put('/atualizar/{id}', [VacationRequestController::class, 'update'])->name('vacationRequests.update');
        Route::delete('/apagar/{id}', [VacationRequestController::class, 'destroy'])->name('vacationRequests.destroy');

        //filtros
        Route::get('vacationRequest/departmentSummary', [VacationRequestController::class, 'departmentSummary'])->name('vacationRequests.departmentSummary');
        Route::get('vacationRequest/searchEmployee', [VacationRequestController::class, 'searchEmployee'])->name('vacationRequests.searchEmployee');
        Route::get('vacation-request/pdf-filtered', [VacationRequestController::class, 'pdfAll'])->name('vacationRequests.exportFilteredPDF');
        Route::get('vacationRequest/pdf', [VacationRequestController::class, 'pdfAll'])->name('vacationRequests.pdfAll');
    });
    // fim Pedido de Férias (Vacation Request) 

    // inicio fornecedo(supplier) 
    Route::prefix('fornecedor')->group(function () {

        Route::get('/listar', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/criar', [SupplierController::class, 'create'])->name('suppliers.create');
        Route::post('/salvar', [SupplierController::class, 'store'])->name('suppliers.store');
        Route::get('/detalhes/{id}', [SupplierController::class, 'show'])->name('suppliers.show');
        Route::get('/editar/{id}/edit', [SupplierController::class, 'edit'])->name('suppliers.edit');
        Route::put('/atualizar/{id}', [SupplierController::class, 'update'])->name('suppliers.update');
        Route::delete('/apagar/{id}', [SupplierController::class, 'destroy'])->name('suppliers.destroy');
    });
    // fim fornecedo(supplier) 

    //inicio infraestrutura (infrastructure)
    Route::prefix('infraestrutura')->group(function () {

        Route::get('/listar', [InfrastructureController::class, 'index'])->name('infrastructures.index');
        Route::get('/criar', [InfrastructureController::class, 'create'])->name('infrastructures.create');
        Route::post('/salvar', [InfrastructureController::class, 'store'])->name('infrastructures.store');
        Route::get('/detalhes/{id}', [InfrastructureController::class, 'show'])->name('infrastructures.show');
        Route::get('/editar/{id}/edit', [InfrastructureController::class, 'edit'])->name('infrastructures.edit');
        Route::put('/atualizar/{id}', [InfrastructureController::class, 'update'])->name('infrastructures.update');
        Route::delete('/apagar/{id}', [InfrastructureController::class, 'destroy'])->name('infrastructures.destroy');

        //relatorios
        Route::get('/relatorio', [InfrastructureController::class, 'reportAll'])->name('infrastructures.allPdf');

        // outras rotas
        Route::get('/entrada', [InfrastructureController::class, 'materialInput'])->name('infrastructures.materialInput');
        Route::get('/saida', [InfrastructureController::class, 'materialOutput'])->name('infrastructures.materialOutput');
        Route::put('input', [InfrastructureController::class, 'input'])->name('infrastructures.input');
        Route::put('output', [InfrastructureController::class, 'output'])->name('infrastructures.output');
        Route::get('/limite/{id}', [InfrastructureController::class, 'inputLimit'])->name('input.limit');
    });
    //fim infraestrutura (infrastructure)

    //inicio patrimonio (heritage)
    Route::prefix('patrimonio')->group(function () {

        Route::get('/listar', [HeritageController::class, 'index'])->name('heritages.index');
        Route::get('/criar', [HeritageController::class, 'create'])->name('heritages.create');
        Route::post('/salvar', [HeritageController::class, 'store'])->name('heritages.store');
        Route::get('/detalhes/{id}', [HeritageController::class, 'show'])->name('heritages.show');
        Route::get('/editar/{id}/edit', [HeritageController::class, 'edit'])->name('heritages.edit');
        Route::put('/atualizar/{id}', [HeritageController::class, 'update'])->name('heritages.update');
        Route::delete('/apagar/{id}', [HeritageController::class, 'destroy'])->name('heritages.destroy');

        //relatorios
        Route::get('/relatorio', [HeritageController::class, 'reportAll'])->name('heritages.allPdf');

        Route::get('/entrada', [HeritageController::class, 'materialInput'])->name('heritages.materialInput');
        Route::get('/saida', [HeritageController::class, 'materialOutput'])->name('heritages.materialOutput');
        Route::put('input', [HeritageController::class, 'input'])->name('heritages.input');
        Route::put('output', [HeritageController::class, 'output'])->name('heritages.output');
        Route::get('/limite/{id}', [HeritageController::class, 'inputLimit'])->name('input.limit');
    });
    //fim patrimonio (heritage)


    // inicio users routes
    Route::prefix('utilizadores')->group(function () {

        Route::get('/listar', [AdminAuthController::class, 'index'])->name('users.index');
        Route::get('/criar', [AdminAuthController::class, 'create'])->name('users.create');
        Route::post('/salvar', [AdminAuthController::class, 'store'])->name('users.store');
        Route::get('/detalhes/{id}', [AdminAuthController::class, 'show'])->name('users.show');
        Route::get('/editar/{id}/edit', [AdminAuthController::class, 'edit'])->name('users.edit');
        Route::put('/atualizar/{id}', [AdminAuthController::class, 'update'])->name('users.update');
        Route::delete('/apagar/{id}', [AdminAuthController::class, 'destroy'])->name('users.destroy');
        Route::post('/login', [AdminAuthController::class, 'login'])->name('users.login');

        //cotrato em pdf
        Route::get('/{id}/contract', [AdminAuthController::class, 'contractPdf'])->name('users.contract');
    });
    // fim users routes


    // inicio Administrative Area (RH) routes
    Route::prefix('area-administrativa')->group(function () {
        Route::get('/ferias-pendentes', [\App\Http\Controllers\Admin\AdministrativeAreaController::class, 'pendingVacations'])->name('hr.pendingVacations');
        Route::post('/encaminhar-ferias/{id}', [\App\Http\Controllers\Admin\AdministrativeAreaController::class, 'forwardVacation'])->name('hr.forwardVacation');
    });
    //fim Administrative Area (RH) routes

    // inicio Director General routes
    Route::prefix('direcao-geral')->group(function () {
        Route::get('/ferias-pendentes', [\App\Http\Controllers\Admin\DirectorGeneralController::class, 'pendingVacations'])->name('director.pendingVacations');
        Route::post('/aprovar-ferias/{id}', [\App\Http\Controllers\Admin\DirectorGeneralController::class, 'approveVacation'])->name('director.approveVacation');
        Route::post('/rejeitar-ferias/{id}', [\App\Http\Controllers\Admin\DirectorGeneralController::class, 'rejectVacation'])->name('director.rejectVacation');
        Route::get('/download-ferias-assinada/{id}', [VacationRequestController::class, 'downloadSignedPdf'])->name('director.downloadSignedPdf');
    });
    //fim Director General routes
});
