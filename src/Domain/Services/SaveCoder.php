<?php 

namespace App\Domain\Services;

use App\Domain\Contracts\IRepositories;
use App\Domain\Models\Coder;

class SaveCoder {

    private IRepositories $repository;

    public function __construct(IRepositories $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data)
    {
        $newCoder = new Coder($data['name'], $data['subject']);
        $this->repository->saveCoder($newCoder);

        return $newCoder;
    }

}

?>