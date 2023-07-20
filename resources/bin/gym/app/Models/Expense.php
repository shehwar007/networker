<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $table = "expenses";
    protected $guarded = [];
    
    public const VALIDATION_RULES = [
        'expense_title' => 'required',    
        'expense_category' => 'required',
        'expense_amount' => 'required',
        'expense_date' => 'nullable',
        'expense_payment_type' => 'required',           
        'expense_description' => 'nullable',
        'expense_attachment' => 'nullable',
        'status' => 'required|in:Paid,Unpaid',
  
    ];
   
}
