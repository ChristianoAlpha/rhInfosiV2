<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EmployeeeController;
use App\Http\Controllers\DepartmentHeadController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InternEvaluationController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Site\FrontendController;
use App\Http\Controllers\NewChatController;
use App\Http\Controllers\EmployeeEvaluationController;

/* Cheguei chegando Blm */

/*
|--------------------------------------------------------------------------
| start Rotas Login/Logout e Recuperação de Senha - Laravel Sanctum
|--------------------------------------------------------------------------
*/

Route::get("login", [AuthController::class, "showLoginForm"])->name("login");
Route::post("login", [AuthController::class, "login"])->name("login.post");
Route::post("logout", [AuthController::class, "logout"])->name("logout");

Route::get("forgotPassword", [AuthController::class, "showForgotPasswordForm"])->name("forgotPassword");
Route::post("forgotPassword", [AuthController::class, "sendResetLink"])->name("forgotPasswordEmail");
Route::get("resetPassword/{token}", [AuthController::class, "showResetForm"])->name("resetPassword");
Route::post("resetPassword", [AuthController::class, "resetPassword"])->name("resetPasswordUpdate");

// Rotas adicionais para compatibilidade (opcional)
Route::get("password/reset/{token}", [AuthController::class, "showResetForm"])->name("password.reset");
Route::post("password/reset", [AuthController::class, "resetPassword"])->name("password.update");

Route::get("/", [FrontendController::class, "index"])->name("frontend.index");
Route::get("/sobre", [FrontendController::class, "about"])->name("frontend.about");
Route::get("/estatuto", [FrontendController::class, "statute"])->name("frontend.statute");
Route::get("/diretoria", [FrontendController::class, "directors"])->name("frontend.directors");
Route::get("/diretoria/{id}", [FrontendController::class, "showDirector"])->where("id", "[0-9]+")->name("frontend.directors.show"); // Página da Diretoria
Route::get("/contato", [FrontendController::class, "contact"])->name("frontend.contact");

Route::middleware(["auth"])->group(function () {

     Route::get(
          "employeeEvaluations/searchEmployee",
          [EmployeeEvaluationController::class, "searchEmployee"]
     )->name("employeeEvaluations.searchEmployee");

     Route::get(
          "employeeEvaluations/pdf-all",
          [EmployeeEvaluationController::class, "pdfAll"]
     )->name("employeeEvaluations.pdfAll");

     Route::get(
          "employeeEvaluations/{employeeEvaluation}/pdf",
          [EmployeeEvaluationController::class, "pdf"]
     )->name("employeeEvaluations.pdf");

     // A seguir, o resource:
     Route::resource("employeeEvaluations", EmployeeEvaluationController::class)
          ->names([
               "index"   => "employeeEvaluations.index",
               "create"  => "employeeEvaluations.create",
               "store"   => "employeeEvaluations.store",
               "show"    => "employeeEvaluations.show",
               "edit"    => "employeeEvaluations.edit",
               "update"  => "employeeEvaluations.update",
               "destroy" => "employeeEvaluations.destroy",
          ]);

     // ====================== Perfil do Funcionário ======================
     Route::get("my-profile", [EmployeeeController::class, "myProfile"])->name("profile");

     // ====================== Avaliação dos Estagiários (Intern Evaluation) ======================
     Route::get("internEvaluation/searchIntern", [InternEvaluationController::class, "searchIntern"])->name("internEvaluation.searchIntern");
     Route::get("internEvaluation/pdf/{id}", [InternEvaluationController::class, "pdf"])->name("internEvaluation.pdf");
     Route::get("internEvaluation/pdf", [InternEvaluationController::class, "pdfAll"])->name("internEvaluation.pdfAll");
     Route::resource("internEvaluation", InternEvaluationController::class);

     // ====================== Mapa de Efetividade (Attendance) ======================
     Route::get("attendance/pdf", [AttendanceController::class, "pdfAll"])->name("attendance.pdfAll");
     Route::get("attendance/dashboard", [AttendanceController::class, "dashboard"])->name("attendance.dashboard");
     Route::get("attendance/check-status", [AttendanceController::class, "checkStatus"])->name("attendance.checkStatus");
     Route::get("attendance/createBatch", [AttendanceController::class, "createBatch"])->name("attendance.createBatch");
     Route::post("attendance/storeBatch", [AttendanceController::class, "storeBatch"])->name("attendance.storeBatch");
     Route::resource("attendance", AttendanceController::class)->except(["show"]);

     // ====================== Grupo de Chefe de Departamento ======================
     Route::prefix("department-head")->name("dh.")->group(function () {
          Route::get("/employee/{id}/vacation/pdf", [DepartmentHeadController::class, "downloadEmployeeVacationPdf"])->name("downloadEmployeeVacationPdf");
          Route::get("/employee/{id}/leave/pdf", [DepartmentHeadController::class, "downloadEmployeeLeavePdf"])->name("downloadEmployeeLeavePdf");
          Route::get("my-employees", [DepartmentHeadController::class, "myEmployees"])->name("myEmployees");
          Route::get("pending-vacations", [DepartmentHeadController::class, "pendingVacations"])->name("pendingVacations");
          Route::post("approve-vacation/{id}", [DepartmentHeadController::class, "approveVacation"])->name("approveVacation");
          Route::post("reject-vacation/{id}", [DepartmentHeadController::class, "rejectVacation"])->name("rejectVacation");

          // Rotas para pedidos de licença
          Route::get("pending-leaves", [DepartmentHeadController::class, "pendingLeaves"])->name("pendingLeaves");
          Route::post("approve-leave/{id}", [DepartmentHeadController::class, "approveLeave"])->name("approveLeave");
          Route::post("reject-leave/{id}", [DepartmentHeadController::class, "rejectLeave"])->name("rejectLeave");

          // Rotas para pedidos de reforma (retirement)
          Route::get("reformas-pendentes", [DepartmentHeadController::class, "pendingRetirements"])->name("pendingRetirements");
          Route::put("reformas/aprovar/{id}", [DepartmentHeadController::class, "approveRetirement"])->name("approveRetirement");
          Route::put("reformas/rejeitar/{id}", [DepartmentHeadController::class, "rejectRetirement"])->name("rejectRetirement");
     });

     // ====================== CHAT DE CONVERSAS (CONVERSATION CHAT) ======================
     Route::get("/new-chat", [NewChatController::class, "index"])->name("new-chat.index");
     //rota para exibir a conversa
     Route::get("/new-chat/{groupId}", [NewChatController::class, "show"])->name("new-chat.show");
     //rota para enviar a mensagem via AJAX
     Route::post("/new-chat/send-message", [NewChatController::class, "sendMessage"])->name("new-chat.sendMessage");
     
});