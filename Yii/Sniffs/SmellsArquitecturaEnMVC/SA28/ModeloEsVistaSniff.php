<?php

/**

 *
 * PHP version 5

 */


class Yii_Sniffs_SmellsArquitecturaEnMVC_SA28_ModeloEsVistaSniff implements PHP_CodeSniffer_Sniff
{
private $arregloInstanciaModelo=array();
private $arregloInstanciaVista=array();
private $arregloClaseModelo=array();
private $arregloClaseVista=array();
private $arregloPosicionVista=array();
private $arregloErrores=array();
private $arregloPosicionModelo=array();
private $contGeneral=0;
private $elementosProcesados=array();



    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
	 return array(T_CLASS,T_INTERFACE,T_FUNCTION,T_TRAIT);
   


    }//end register()

    /**
     * Processes the tokens that this sniff is interested in.
    
     * @param PHP_CodeSniffer_File $phpcsFile The file where the token was found.
     * @param int                  $stackPtr  The position in the stack where
     *                                        the token was found.
     *
     * @return void
     */
//clase = 356
//interface = 358
//function = 335
//hilo 357
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $name = $phpcsFile->getFilename();
        $tokens = $phpcsFile->getTokens();
	if(strpos($name, "models")){
		if($tokens[$stackPtr]['type']=='T_TRAIT'){
			$error = 'Se creo una un Hilo en Modelo.; found %s';
		        $data  = array(trim($tokens[$stackPtr]['content']));
		        $phpcsFile->addError($error, $stackPtr, 'Found', $data);	
		}
		if($tokens[$stackPtr]['type']=='T_INTERFACE'){
			$error = 'Se creo una una Interface en el Modelo.; found %s';
		        $data  = array(trim($tokens[$stackPtr]['content']));
		        $phpcsFile->addError($error, $stackPtr, 'Found', $data);	
		}
		if($tokens[$stackPtr]['type']=='T_FUNCTION'){
			$error = 'Se creo una una Función en el Modelo.; found %s';
		        $data  = array(trim($tokens[$stackPtr]['content']));
		        $phpcsFile->addError($error, $stackPtr, 'Found', $data);	
		}
		if($tokens[$stackPtr]['type']=='T_CLASS'){
			$error = 'Se creo una una Clase en el Modelo.; found %s';
		        $data  = array(trim($tokens[$stackPtr]['content']));
		        $phpcsFile->addError($error, $stackPtr, 'Found', $data);	
		}
	
	}
 	
    }//end process()

 }

?>





