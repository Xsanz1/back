<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ExpenseModel;

class ExpenseController extends BaseController
{
    use ResponseTrait;

    public function addExpense()
    {
        $request = service('request');
        $expenseModel = new ExpenseModel();

        $data = [
            'title'       => $request->getPost('title'),
            'amount'      => $request->getPost('amount'),
            'category'    => $request->getPost('category'),
            'description' => $request->getPost('description'),
            'date'        => $request->getPost('date'),
        ];

        try {
            // Validations
            if (empty($data['title']) || empty($data['category']) || empty($data['description']) || empty($data['date'])) {
                return $this->failValidation('All fields are required!');
            }

            if ($data['amount'] <= 0 || !is_numeric($data['amount'])) {
                return $this->failValidation('Amount must be a positive number!');
            }

            $expenseModel->insert($data);
            return $this->respondCreated(['message' => 'Expense Added']);
        } catch (\Exception $e) {
            return $this->failServerError('Server Error');
        }
    }

    public function getExpense()
    {
        $expenseModel = new ExpenseModel();

        try {
            $expenses = $expenseModel->orderBy('created_at', 'desc')->findAll();
            return $this->respond($expenses);
        } catch (\Exception $e) {
            return $this->failServerError('Server Error');
        }
    }

    public function deleteExpense($id)
    {
        $expenseModel = new ExpenseModel();

        try {
            $expense = $expenseModel->find($id);

            if (!$expense) {
                return $this->failNotFound('Expense not found');
            }

            $expenseModel->delete($id);
            return $this->respondDeleted(['message' => 'Expense Deleted']);
        } catch (\Exception $e) {
            return $this->failServerError('Server Error');
        }
    }
}
