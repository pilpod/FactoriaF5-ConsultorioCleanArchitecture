<?php 

namespace App\Domain\Services;

use App\Domain\Contracts\IRepositories;

class ListAllCoders {

    private IRepositories $repository;

    public function __construct(IRepositories $repository)
    {
        $this->repository = $repository;
    }

    public function execute()
    {
        $allCoders = $this->repository->listAllCoders();
        return $allCoders;
    }

}

?>