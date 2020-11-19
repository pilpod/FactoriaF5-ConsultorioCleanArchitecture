<?php 

namespace Tests\Domain\Services;

use PHPUnit\Framework\TestCase;
use Tests\Double\MysqlRepositoryFake;
use App\Infrastructure\DB\MysqlRepo;
use App\Domain\Services\ApiCodersController;
use App\Domain\Contracts\IRepositories;
use App\Domain\Services\DeleteCoder;

class DeleteCoderTest extends TestCase
{

	public function test_can_delete_a_coder()
	{   
		$id = 52;
		$repository = new MysqlRepositoryFake();
		$service = new DeleteCoder($repository);
		
		$coderDeleted = $service->execute($id);

		$this->$this->assertEquals($id, $coderDeleted->getId());
	}
}


?>
