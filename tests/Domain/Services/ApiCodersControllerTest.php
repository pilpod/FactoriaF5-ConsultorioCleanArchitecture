<?php 

namespace Tests\Controllers\ApiCodersController;

use PHPUnit\Framework\TestCase;
use App\Domain\Services\ApiCodersController;

class ApiCodersControllerTest extends TestCase
{

	public function test_WriteInLoggerFile()
	{   
		$this->assertFileIsReadable($file);
	}
}


?>
