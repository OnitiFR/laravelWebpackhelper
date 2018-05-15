<?php
namespace Oniti\WebPackHelper;

use Config;
/**
* Class permettant de rajouter les fichier généré par webpack
*/
class WebpackHelper
{
  private $manifest_file = null;
  private $allowed_tags = null;
  function __construct(){
    $this->allowed_tags = Config::get('WebpackHelper');
  }

  /**
   * Permet de définir le fichier de manifest et de le parser en Array
   * @param [type]  $path        path to manifest json
   * @param boolean $withoutbase relative path or not.
   */
  public function setManifest($path,$withoutbase = true){
    $path = $withoutbase ? base_path().'/'.$path : $path;
    if(!is_file($path)) throw new \Exception($path." is not a file");

    $string = file_get_contents($path);
    $result = json_decode($string,true);
    if($error = json_last_error() != JSON_ERROR_NONE) throw new \Exception($this->getJsonError());

    $this->manifest_file = $result;
  }
  /**
   * Retourne une traduction de l'erreur json
   */
  private function getJsonError(){
    $error = null;
    switch (json_last_error()) {
      case JSON_ERROR_DEPTH:
      $error = 'The maximum stack depth has been exceeded.';
      break;
      case JSON_ERROR_STATE_MISMATCH:
      $error = 'Invalid or malformed JSON.';
      break;
      case JSON_ERROR_CTRL_CHAR:
      $error = 'Control character error, possibly incorrectly encoded.';
      break;
      case JSON_ERROR_SYNTAX:
      $error = 'Syntax error, malformed JSON.';
      break;
      case JSON_ERROR_UTF8:
      $error = 'Malformed UTF-8 characters, possibly incorrectly encoded.';
      break;
      case JSON_ERROR_RECURSION:
      $error = 'One or more recursive references in the value to be encoded.';
      break;
      case JSON_ERROR_INF_OR_NAN:
      $error = 'One or more NAN or INF values in the value to be encoded.';
      break;
      case JSON_ERROR_UNSUPPORTED_TYPE:
      $error = 'A value of a type that cannot be encoded was given.';
      break;
      default:
      $error = 'Unknown JSON error occured.';
      break;
    }
    return $error;
  }
  /**
   * Permet de savoir si une chaine de caractère fini par la chaine passé en argument
   * @param  [type] $string    string dans la quelle chercher
   * @param  [type] $endString string a trouver
   */
  private function endsWith($string, $endString){
    $length = strlen($endString);
    return $length === 0 ||(substr($string, -$length) === $endString);
  }

  public function getFiles($type){
    if(is_null($this->manifest_file)) throw new \Exception("Manifest not defined");

    $typeFiles = array_filter($this->manifest_file,
        function ($key) use ($type) {
            return $this->endsWith($key,$type);
        },
        ARRAY_FILTER_USE_KEY
    );

    return array_walk($typeFiles,function ($file) use($type){
      echo $this->getTag($type, $file).PHP_EOL;
    });
  }
  /**
   * Créer la balise en fonction de l'extention demandée
   * @param  [type] $type extention
   * @param  [type] $file file path
   * @return [type]       tag
   */
  private function getTag($type,$file){
    if(!in_array($type,$this->allowed_tags)) throw new \Exception($type." unknowed Tag");
    $balise = null;
    switch ($type) {
      case Config::get('WebpackHelper.CSS_EXT'):
        $balise = '<link  rel="stylesheet" type="text/css" href="'.$file.'">';
        break;
      case Config::get('WebpackHelper.JS_EXT'):
        $balise = '<script type="text/javascript" src="'.$file.'"></script>';
        break;
    }
    return $balise;
  }
}
?>
