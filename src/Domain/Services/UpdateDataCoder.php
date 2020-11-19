<?php 

namespace App\Domain\Services;

use App\Domain\Contracts\IRepositories;

class UpdateDataCoder {

    private IRepositories $repository;
    
    public function __construct(IRepositories $repository)
    {
        $this->repository = $repository;
    }

    public function execute(array $data, $id)
    {
        $coderToUpdate = $this->repository->findById($id);
        $coderToUpdate->rename($data['name']);
        $coderToUpdate->editSubject($data['subject']);
        $this->repository->updateDataCoder($coderToUpdate);

        return $coderToUpdate;
    }

}

?>