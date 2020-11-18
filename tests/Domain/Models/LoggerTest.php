<?php 

namespace Tests\Domain\Models;

use PHPUnit\Framework\TestCase;
use App\Domain\Models\Logger;

class LoggerTest extends TestCase
{

	public function test_is_logger_file_readable()
	{   
		
		$this->assertFileIsReadable($file);
	}
}


?>
