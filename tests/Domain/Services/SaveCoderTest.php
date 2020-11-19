<?php 

namespace Tests\Domain\Services;

use PHPUnit\Framework\TestCase;
use App\Domain\Services\ApiCodersController;
use Tests\Double\MysqlRepositoryFake;
use App\Domain\Contracts\IRepositories;
use App\Domain\Services\SaveCoder;

class SaveCoderTest extends TestCase
{

	public function test_can_save_a_coder()
	{   
        $data = ["name" => "Giacomo", "subject" => "Hola mundo"];
		$repository = new MysqlRepositoryFake();
		$service = new SaveCoder($repository);
		
		$coderSaved = $service->execute($data);

		$this->$this->assertEquals("Giacomo", $coderSaved->getName());
		$this->$this->assertEquals("Hola mundo", $coderSaved->getSubject());
	}
}


?>
