<?php 

namespace Tests\Double;

use App\Domain\Contracts\IRepositories;
use App\Domain\Models\Coder;

class MysqlRepositoryFake implements IRepositories {

    public function deleteCoder(Coder $coder)
    {
        return $coder;
    }

    public function saveCoder(Coder $coder)
    {
        return $coder;
    }

}


?>