<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * summary
 */
class Dbbackups
{
	function __construct()
	{
		date_default_timezone_set('America/Sao_Paulo');
	}

	function dbdump()
	{
		$database = 'farol';
		$user = 'root';
		$pass = '';
		$host = 'localhost';
		$dir = 'dbbackups/farol'.date("Y-m-d-H-i-s").'.sql';
		exec("C:\\\\xampp\\\\mysql\\\\bin\\\\mysqldump.exe --user={$user} --password={$pass} --host={$host} {$database} --result-file={$dir} 2>&1", $output);
		var_dump($output);
		$files = glob( 'dbbackups/*.*' );

		if (count($files) > 3) {
			$exclude_files = array('.', '..');
			if (!in_array($files, $exclude_files)) {
// Sort files by modified time, latest to earliest
// Use SORT_ASC in place of SORT_DESC for earliest to latest
				array_multisort(
					array_map( 'filemtime', $files ),
					SORT_NUMERIC,
					SORT_DESC,
					$files
				);
			}

			for ($i=3; $i<count($files); $i++) {
				unlink($files[$i]);
			}
		}
	}

	function dbrestore($num=3)
	{

	}
}