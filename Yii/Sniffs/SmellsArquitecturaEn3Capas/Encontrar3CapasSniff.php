<?php

/**

 *
 * PHP version 5
 *

 */


class Yii_Sniffs_SmellsArquitecturaEn3Capas_Encontrar3CapasSniff implements PHP_CodeSniffer_Sniff
{
private $carpetaModelo;
private $carpetaControlador;
private $carpetaVista;
private $arregloArch=array();
private $vista=false;
private $modelo=false;
private $controlador=false;
private $noEntrar=false;
private $noMostrarMensaje=false;
private $contadorReal=0;
private $contadorIrreal=0;
private $contadorSI=0;

    /**
     * Returns the token types that this sniff is interested in.
     *
     * @return array(int)
     */
    public function register()
    {
	
        return array(T_STRING);


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

$cliValues = $phpcsFile->phpcs->cli->getCommandLineValues();
$dh = $cliValues['files'][0];


$cadena=$dh;
$this->contadorReal=$this->contadorReal+1;
$this->recorrerDirectorio($cadena);

	if ($this->noEntrar==false){
	
	$this->contadorIrreal=1;
}else{
$this->contadorIrreal=$this->contadorReal+1;
}
		if($this->noMostrarMensaje==false){
			if($this->contadorReal>$this->contadorIrreal){
			 	$error = 'No se tienen los tres compoenentes Yii Modelo Vista y Controlador; found %s';
				if($this->vista==false){
                			$data="Falta Vista";
				}
				if($this->modelo==false){
                			$data="Falta Modelo";
				}if($this->controlador==false){
                			$data="Falta Controlador";
				}
                		$phpcsFile->addError($error, null, 'Found', $data);

				$this->noMostrarMensaje=true;
			}
		}
	

}//end process()
 


public function recorrerDirectorio($directorio){
if ($this->noEntrar==false){
	$ficheros1  = scandir($directorio,1);
	
	$cadena=$directorio;
	foreach ($ficheros1 as &$elemento){
	if ($elemento!="." and $elemento!=".."){
	$cadena=$cadena."/".$elemento;
   	if(is_dir($cadena))//verificamos si es o no un directorio
        {	
		if (strpos($cadena, "views")){
			
			if($this->vista==false){
			$this->contadorSI=$this->contadorSI+1;
			}
			$this->vista=true;
		}
		if(strpos($cadena, "models")){
			
			if($this->modelo==false){
			$this->contadorSI=$this->contadorSI+1;
			}
			$this->modelo=true;
		}
		if (strpos($cadena, "controllers")){

			if($this->controlador==false){
				$this->contadorSI=$this->contadorSI+1;
			}
			$this->controlador=true;
		}

		
		if ($this->contadorSI==3){

					
					$this->noEntrar=true;
					break;
				}
		$this->recorrerDirectorio($cadena);
		
		

    	
    	}//fin del foreach

  
	$cadena=$directorio;
		}//fin del dir
	}//fin del . y ..
     }//fin del if no entrar
  }//fin del método
}//end class

?>




