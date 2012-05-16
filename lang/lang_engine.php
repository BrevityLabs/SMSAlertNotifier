<?php 
include("en.php");
include("fr.php");
//$lang=$_SESSION['lang'];

class Translator{
	private static $strs = array();
	private static $currlang = 'en';

	public static function loadTranslation($lang, $strs){
		if (empty(self::$strs[$lang]))
			self::$strs[$lang] = array();

		self::$strs[$lang] = array_merge(self::$strs[$lang], $strs);
	}

	public static function setDefaultLang($lang){
		self::$currlang = $lang;
	}

	public static function translate($key, $lang=""){
		if ($lang == "") $lang = self::$currlang;
		$str = self::$strs[$lang][$key];
		if (empty($str)){
			$str = "$lang.$key";
		}
		return $str;
	}

	public static function freeUnused(){
		foreach(self::$strs as $lang => $data){
			if ($lang != self::$currlang){
				$lstr = self::$strs[$lang]['langname'];
				self::$strs[$lang] = array();
				self::$strs[$lang]['langname'] = $lstr;
			}
		}
	}

	public static function getLangList(){
		$list = array();
		foreach(self::$strs as $lang => $data){
			$h['name'] = $lang;
			$h['desc'] = self::$strs[$lang]['langname'];
			$h['current'] = $lang == self::$currlang;
			$list[] = $h;
		}
		return $list;
	}

	public static function &getAllStrings($lang){
		return self::$strs[$lang];
	}

}

function generateTemplateStrings($arr){
	$trans = array();
	foreach($arr as $totrans){
		$trans[$totrans] = Translator::translate($totrans);
	}
	return $trans;
}

?>