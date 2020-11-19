<?php 

namespace App\Domain\Services;

use App\Domain\Contracts\IRepositories;

class CoderToEdit {

    private IRepositories $repository;

    public function __construct(IRepositories $repository)
    {
        $this->repository = $repository;
    }

    public function execute($id)
    {
        $coderToEdit = $this->repository->findById($id);
        return $coderToEdit;
    }

}

?>