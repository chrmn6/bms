<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Budget;
use App\Models\ProgramExpense;

class BudgetController extends Controller
{
    public function index()
    {
        $budgets = Budget::orderBy('created_at', 'desc')->paginate(20);
        return view('admin.budget.index', compact('budgets'));
    }

    public function create()
    {
        return view('admin.budget.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        Budget::create([
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        if ($request->header('HX-Request')) {
            $budgets = Budget::orderBy('created_at', 'desc')->paginate(20);
            return response()->view('admin.budget.table', compact('budgets'))->header('HX-Trigger', 'budgetCreated');
        }

        return redirect()->route('admin.budget.index')->with('success', 'Budget added successfully!');
    }

    public function edit(Budget $budget, Request $request)
    {
        if ($request->header('HX-Request')) {
            return view('admin.budget.edit', compact('budget'));
        }

        return redirect()->route('admin.budget.index');
    }

    public function update(Request $request, Budget $budget)
    {
        $request->validate([
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        $budget->update([
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        if ($request->header('HX-Request')) {
            $budgets = Budget::orderBy('created_at', 'desc')->paginate(20);
            return response()->view('admin.budget.table', compact('budgets'))->header('HX-Trigger', 'budgetUpdated');
        }

        return redirect()->route('admin.budget.index')->with('success', 'Budget updated successfully!');
    }

    public function transactions()
    {
        $expenses = ProgramExpense::with(['program', 'official.resident'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        $totalBudget = Budget::sum('amount');
        $totalExpenses = ProgramExpense::sum('amount');
        $remainingBudget = $totalBudget - $totalExpenses;

        return view('admin.budget.transactions', compact('expenses', 'totalBudget', 'totalExpenses', 'remainingBudget'));
    }
}
