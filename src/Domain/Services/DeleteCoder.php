<?php 

namespace App\Domain\Services;

use App\Domain\Contracts\IRepositories;

class DeleteCoder {

    private IRepositories $repository;

    public function __construct(IRepositories $repository)
    {
        $this->repository = $repository;
    }

    public function execute($id)
    {
        $coderToDelete = $this->repository->findById($id);
        $this->repository->deleteCoder($coderToDelete);
        return $coderToDelete;
    }

}


?>