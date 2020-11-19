<?php 

namespace App\Domain\Contracts;

use App\Domain\Models\Coder;

Interface IRepositories {

    public function deleteCoder(Coder $coder);

    public function saveCoder(Coder $coder);

    public function listAllCoders();

}

?>