<?php
include 'ComparadorDeListas.php';

class Yii_Sniffs_SmellsArquitecturaEnMVC_SA26_BuscarInstanciasSniff implements PHP_CodeSniffer_Sniff
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
	




         if (strpos($name, "views")) {
	    if($tokens[$stackPtr]['code']==300){
		array_push($this->arregloInstancias,$tokens[$posicion]['content']."*".$tokens[$stackPtr]['line']."*".$name);
               
	    }//fin del if

	    if($tokens[$stackPtr]['code']==356){
	
		array_push($this->arregloClases,$tokens[$posicion]['content']."*".$name);
	       
	  }//fin del if
	$comparador= new ComparadorDeListas($this->arregloClases, $this->arregloInstancias);
	$comparador->compararClases();
	}//fin del if strpos
	
    }//end process()
 

}//end class

?>
