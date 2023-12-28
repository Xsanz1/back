<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\IncomeModel;

class IncomeController extends BaseController
{
    use ResponseTrait;

    public function addIncome()
    {
        $request = service('request');
        $incomeModel = new IncomeModel();

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

            $incomeModel->insert($data);
            return $this->respondCreated(['message' => 'Income Added']);
        } catch (\Exception $e) {
            return $this->failServerError('Server Error');
        }
    }

    public function getIncomes()
    {
        $incomeModel = new IncomeModel();

        try {
            $incomes = $incomeModel->orderBy('created_at', 'desc')->findAll();
            return $this->respond($incomes);
        } catch (\Exception $e) {
            return $this->failServerError('Server Error');
        }
    }

    public function deleteIncome($id)
    {
        $incomeModel = new IncomeModel();

        try {
            $income = $incomeModel->find($id);

            if (!$income) {
                return $this->failNotFound('Income not found');
            }

            $incomeModel->delete($id);
            return $this->respondDeleted(['message' => 'Income Deleted']);
        } catch (\Exception $e) {
            return $this->failServerError('Server Error');
        }
    }
}
