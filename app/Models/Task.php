<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id', 'type_id', 'status_id',
        'work_name', 'prod_name',
        'units', 'count',
        'supplier_or_performer', 'status',
        'date_of_payment_plan', 'date_of_payment_fact',
        'date_of_start_plan', 'date_of_start_fact',
        'date_of_end_plan', 'date_of_end_fact',
    ];
}
