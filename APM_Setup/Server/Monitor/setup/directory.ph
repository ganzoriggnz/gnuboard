<?
	$temp = $_SERVER[argv];
	$tmp_str = $temp[0];
	$MAINDIR = str_replace("\Server\Monitor\setup\directory.ph", "", $tmp_str);
	$UPDATE_MAINDIR = ereg_replace("[\\]", "/", $MAINDIR);
	$UPDATE_MAINDIR = ereg_replace("//", "/", $UPDATE_MAINDIR);

	function updateDir($chk_file)
	{
		global $MAINDIR, $UPDATE_MAINDIR;

		$n_str = array("C:/APM_Setup");

		$o_str = array($UPDATE_MAINDIR);

		if( file_exists($chk_file) )
		{
			echo "UPDATING :: " . $chk_file . "\n";

			@rename($chk_file, $chk_file . ".tmpfile");

			$loadfile = @file($chk_file . ".tmpfile");
			$savefile = @fopen($chk_file, "a");

			for( $i=0; $i<@count($loadfile); $i++)
			{
				$tmp_str = str_ireplace($n_str, $o_str, $loadfile[$i]);
				@fputs($savefile, $tmp_str);
				unset($tmp_str);
			}

			@fclose($savefile);
			unset($loadfile);

			@unlink($chk_file . ".tmpfile");
		}
	}

	function getFileListAndUpdate($file_name)
	{
		global $UPDATE_MAINDIR;
		$fp = fopen($file_name, 'r');
		while (!feof($fp)) {
			$line = fgets($fp);
			$line = ereg_replace( "\@UPDATE_ROOTDIR\@", $UPDATE_MAINDIR, $line );
			$line = rtrim($line);
			updateDIR($line);
		}
		fclose($fp);
	}

	getFileListAndUpdate($UPDATE_MAINDIR . "/Server/Monitor/setup/directory.lst");
?>