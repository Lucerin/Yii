<?php

class Yii_Sniffs_SmellsArquitecturaEnMVC_SA25_ComunicionDirectaVistaModeloSniff implements PHP_CodeSniffer_Sniff
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
	
          return array(T_NEW,T_CLASS,T_DOUBLE_COLON);


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


	$this->contGeneral=$this->contGeneral+1;
 	$name = $phpcsFile->getFilename();
        $tokens = $phpcsFile->getTokens();

	
	$posicion =$phpcsFile-> findNext(T_STRING, $stackPtr +1 ,null, false, null, true);
	

		//es una instancias
	 if($tokens[$stackPtr]['code']==300 or $tokens[$stackPtr]['code']==382){
		if(strpos($name, "views")){
			array_push($this->arregloInstanciaVista,$tokens[$posicion]['content']);
			array_push($this->arregloPosicionVista,$tokens[$stackPtr]['content']."*".$tokens[$posicion]['line']);

		}
		if(strpos($name, "models")){
			

			array_push($this->arregloInstanciaModelo,$tokens[$posicion]['content']);
			array_push($this->arregloPosicionModelo,$tokens[$stackPtr]['content']."*".$tokens[$posicion]['line']);
		}
		
	}
       if($tokens[$stackPtr]['code']==356){

		//es una clase
	
		if(strpos($name, "views")){
			
			array_push($this->arregloClaseVista,$tokens[$posicion]['content']);
			
		}
		if(strpos($name, "models")){

			array_push($this->arregloClaseModelo,$tokens[$posicion]['content']);
			
		}
	}
	if (sizeof($this->arregloInstanciaModelo)>0) {
		if(sizeof($this->arregloClaseVista)>0){
			$this->compararArreglos($this->arregloInstanciaModelo,$this->arregloClaseVista,$this->arregloPosicionModelo);
		}	
	}
	if (sizeof($this->arregloInstanciaVista)>0){
		if(sizeof($this->arregloClaseModelo)>0){
			$this->compararArreglos($this->arregloInstanciaVista,$this->arregloClaseModelo,$this->arregloPosicionVista);
		}	
	}
	
	foreach($this->arregloErrores as &$err){
				
			if(in_array($err, $this->elementosProcesados)==false){
				$cadenita = explode("*", $err);
				$posicionAnterior =$phpcsFile-> findNext(T_STRING, $stackPtr -2 ,null, false, null, true);
				
				$error = 'Vista accede y manipula al Modelo.; found %s';
			 	$data  = $cadenita[2]." ".$cadenita[0]."() en linea ".$cadenita[1];
			 	$phpcsFile->addError($error, $stackPtr, 'Found', $data);
				array_push($this->elementosProcesados,$err);

			}

	}				
				
		

}//end process()
public function compararArreglos($inst,$clase,$pos){

	$contPos=0;
	$puntero=0;
	foreach ($inst as &$instancias){
		$cont=0;
		$puntero=0;
		foreach ($pos as &$elem){
			
			
			if ($contPos==$cont){
				$puntero=$elem;
				$pedazos = explode("*", $elem);
			}
			$cont=$cont+1;
		}
		
		if(in_array($instancias, $clase)==true){
			if(in_array($instancias."*".$pedazos[1]."*".$pedazos[0],$this->arregloErrores)==false){
				
				array_push($this->arregloErrores,$instancias."*".$pedazos[1]."*".$pedazos[0]);
			}
		}
	$contPos=$contPos+1;

	}//fin foreach

}//FIN DE FUNCTION


 }

?>





