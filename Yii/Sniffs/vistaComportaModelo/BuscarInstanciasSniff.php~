<?php
include 'ComparadorDeListas.php';
/**
 * This sniff prohibits the use of Perl style hash comments.
 *
 * PHP version 5
 *
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Your Name <you@domain.net>
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   SVN: $Id: coding-standard-tutorial.xml,v 1.9 2008-10-09 15:16:47 cweiske Exp $
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */

/**
 * This sniff prohibits the use of Perl style hash comments.
 *
 * An example of a hash comment is:
 *
 * <code>
 *  # This is a hash comment, which is prohibited.
 *  $hello = 'hello';
 * </code>
 * 
 * @category  PHP
 * @package   PHP_CodeSniffer
 * @author    Your Name <you@domain.net>
 * @license   http://matrix.squiz.net/developer/tools/php_cs/licence BSD Licence
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PHP_CodeSniffer
 */
class Yii_Sniffs_SA26_Modelo_en_Vista_BuscarInstanciasSniff implements PHP_CodeSniffer_Sniff
{
private $arregloInstancias=array();
private $arregloClases=array();
private $arregloErrores=array(); //contiene la ubicación y nombre del arhiuo.
	
    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {

        return array(T_NEW,T_CLASS);


    }//end register()

    /**
     * Processes the tokens that this sniff is interested in.
    
     * @param PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $name = $phpcsFile->getFilename();
        $tokens = $phpcsFile->getTokens();
	
	$posicion =$phpcsFile-> findNext(T_STRING, $stackPtr +1 ,null, false, null, true);
	

         if ((strpos($name, "views")) or  strpos($name, "models")) {
	    if($tokens[$stackPtr]['code']==300){
		array_push($this->arregloInstancias,$tokens[$posicion]['content']."*".$tokens[$stackPtr]['line']."*".$name);
               
	    }//fin del if

	    if($tokens[$stackPtr]['code']==356){
	
		array_push($this->arregloClases,$tokens[$posicion]['content']."*".$name);
	       
	  }//fin del if
 	  /**if($tokens[$stackPtr]['code']==356 or $tokens[$stackPtr]['code']==300){
       
		$comparador= new ComparadorDeListas($this->arregloClases, $this->arregloInstancias);
	        $comparador->comparar();
	  }**/
	$comparador= new ComparadorDeListas($this->arregloClases, $this->arregloInstancias);
	        
	$comparador->compararClases();
	}//fin del if strpos
	
    }//end process()
 

}//end class

?>
