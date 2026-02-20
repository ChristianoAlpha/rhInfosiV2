<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Employeee extends Authenticatable implements CanResetPasswordContract
{
    use Notifiable, CanResetPassword;

    protected $table = "employeees";
    protected $guarded = ['id'];

    protected $hidden = [
        "password",
        "remember_token",
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, "departmentId");
    }

    public function position()
    {
        return $this->belongsTo(Position::class, "positionId");
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, "specialtyId");
    }

    public function employeeType()
    {
        return $this->belongsTo(EmployeeType::class, "employeeTypeId");
    }

    public function employeeCategory()
    {
        return $this->belongsTo(EmployeeCategory::class, "employeeCategoryId");
    }

    public function course()
    {
        return $this->belongsTo(Course::class, "courseId");
    }

    public function retirement()
    {
        return $this->hasOne(Retirement::class, "employeeId");
    }

    public function secondments()
    {
        return $this->hasMany(Secondment::class, 'employeeId');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, "employeeId");
    }

    public function user()
    {
        return $this->hasOne(User::class, "employeeId");
    }


    public function positionHistories()
    {
        return $this->hasMany(PositionHistory::class, "employeeId")
                    ->with("position")
                    ->orderByDesc("startDate");
    }

    // relacionamento entre employeee e historico de funcionário
    public function employeeHistories()
    {
        return $this->hasMany(EmployeeHistory::class, 'employeeId');
    }


// Trabalhos Extras dos quais este funcionário participou.

    public function extraJobs()
    {
        return $this->belongsToMany(
            ExtraJob::class,
            "extra_job_employees",
            "employeeId",
            "extraJobId"
        )
        ->withPivot("bonusAdjustment","assignedValue")
        ->withTimestamps();
    }

    //relacionamento employeee com mobilety
    public function mobilities()
    {
        return $this->hasMany(Mobility::class, 'employeeId');
    }

    //relacionamento com salarypayment
    public function salaryPayments()
    {
        return $this->hasMany(SalaryPayment::class, 'employeeId');
    }

    //relacionamento com vehicle
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicleId');
    }

    /* relação função -> funcionario */
    public function role(){
        return $this->belongsTo(Role::class, 'roleId');
    }
}