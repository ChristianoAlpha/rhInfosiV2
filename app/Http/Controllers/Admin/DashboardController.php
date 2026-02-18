<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Employeee;
use App\Models\Secondment;
use App\Models\Intern;
use App\Models\Department;
use App\Models\EmployeeType;
use App\Models\EmployeeCategory;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        //Nome do usiário logado
        $response['userName'] = Employeee::where('id', Auth::user()->id)->first();
        // Total de funcionários (ativos + reformados, sem estagiários)
        $response['totalEmployees'] = Employeee::whereIn('employmentStatus', ['active', 'retired'])->count();

        // Ativos: Exclui os destacados
        $response['activeEmployees'] = Employeee::where('employmentStatus', 'active')
            ->whereDoesntHave('secondments')
            ->count();

        // Só reformados
        $response['retiredEmployees'] = Employeee::where('employmentStatus', 'retired')->count();

        // Destacados: Apenas funcionários que ainda estão 'active'
        $response['highlightedEmployees'] = Secondment::whereHas('employee', function($q) {
                $q->where('employmentStatus', 'active');
            })
            ->distinct('employeeId')
            ->count('employeeId');

        // Total de estagiários
        $response['totalInterns'] = Intern::count();

        // Funcionários efetivos e contratados (apenas nos ativos não destacados)
        $permanentType = EmployeeType::where('name', 'Efetivo')->first();
        $contractType = EmployeeType::where('name', 'Contratado')->first();

        $response['permanentEmployees'] = $permanentType
            ? Employeee::where('employmentStatus', 'active')
                ->whereDoesntHave('secondments')
                ->where('employeeTypeId', $permanentType->id)
                ->count()
            : 0;

        $response['contractEmployees'] = $contractType
            ? Employeee::where('employmentStatus', 'active')
                ->whereDoesntHave('secondments')
                ->where('employeeTypeId', $contractType->id)
                ->count()
            : 0;

        // Funcionários por categoria (simples, contagem direta)
        $categoryData = EmployeeCategory::withCount('employees')
            ->get()
            ->map(function($category) {
                $count = isset($category->employees_count) ? $category->employees_count : 0;
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                    'count' => $count
                ];
            })->filter(function ($category) {
                return $category['count'] > 0; // Filtra categorias sem funcionários
            })->values();

        // Chefes de departamento
        $admins = Admin::where('role', 'department_head')
            ->whereNotNull('employeeId')
            ->with('employee.department')
            ->get();

        $response['departmentHeads'] = $admins->map->employee->filter();

        // Passar dados a JS em JSON (valores re-indexados)
        $response['categoryDataJson'] = $categoryData->toJson();

        $response['effectivePercentage'] = $response['activeEmployees'] > 0
            ? round(($response['permanentEmployees'] / $response['activeEmployees']) * 100, 2)
            : 0;

        $response['contractPercentage'] = $response['activeEmployees'] > 0
            ? round(($response['contractEmployees'] / $response['activeEmployees']) * 100, 2)
            : 0;

        return view('admin.dashboard.index', $response);
    }
}
