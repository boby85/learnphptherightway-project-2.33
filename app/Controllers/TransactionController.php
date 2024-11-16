<?php

namespace App\Controllers;

use App\Exceptions\FileNotFoundException;
use App\Models\Transaction;
use App\View;

class TransactionController
{
    public function index()
    {
        return View::make('transactions', []);
    }

    public function create(): View
    {
        return View::make('create');
    }

    /**
     * @throws FileNotFoundException
     */
    public function store()
    {
        $filePath = STORAGE_PATH . '/' . $_FILES['fileName']['name'];
        if ($filePath) {
            move_uploaded_file($_FILES['fileName']['tmp_name'], $filePath);
        } else {
            throw new FileNotFoundException();
        }

        $this->parseFile($filePath);
    }

    public function parseFile($file)
    {
        $finalArray = [];
        if (($fp = fopen($file, "r")) !== false) {
            while (($data = fgetcsv($fp, null, ",")) !== false) {
                $parsed[] = $data;
            }
            array_shift($parsed); // Remove first line from file
            $removals = array("$", ",");
            foreach ($parsed as $line) {
                $line[3] = str_replace($removals, '', $line[3]);
                array_push($finalArray, $line);
            }
        }
        fclose($fp);
        $transaction = new Transaction();
        $transaction->create($finalArray);

        header('Location: /transactions');
    }
}