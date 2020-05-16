<?php declare(strict_types=1);

namespace App\Http\Contracts;

interface MovieRepositoryInterface
{
    public function findById($id);
}