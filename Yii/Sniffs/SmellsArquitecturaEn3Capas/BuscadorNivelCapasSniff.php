<?php

/**

 *
 * PHP version 5
 *

 */


class Yii_Sniffs_SmellsArquitecturaEn3Capas_BuscadorNivelCapasSniff implements PHP_CodeSniffer_Sniff
{

private $arregloArch=array();
private $arregloPosicion=array();
private $arregloElementos=array();
private $contadorElementos=0;
private $c=0;
private $arregloErrores=array();
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

$this->c=$this->c+1;
$cliValues = $phpcsFile->phpcs->cli->getCommandLineValues();
$dh = $cliValues['files'][0];


$cadena=$dh;

$this->recorrerDirectorio($cadena);

if ($this->c==1){



$this->compararCarpetas();

			foreach($this->arregloErrores as &$err){
				echo "\n";	
				$error = 'Los componentes de Yii no están al mismo nivel.; found %s';
			 	$data  = $err;
			 	$phpcsFile->addError($error, null, 'Found', $data);
				echo "\n";
			}
}
}//end process()
 


public function recorrerDirectorio($directorio){

	$ficheros1  = scandir($directorio,1);
	$cont=0;
	$cont2=0;
	$cadena=$directorio;
	foreach ($ficheros1 as &$elemento){
	
	if ($elemento!="." and $elemento!=".."){
	$cadena=$cadena."/".$elemento;
	
   	    if(is_dir($cadena))//verificamos si es o no un directorio
 		{	
		
			if(strpos($cadena, "views")){
				
			  if (in_array($cadena, $this->arregloArch)==false) {
				
				if (in_array("views*".strpos($cadena, "views"), $this->arregloElementos)==false) {
							array_push($this->arregloArch,$cadena);
							array_push($this->arregloPosicion,strpos($cadena, "views"));
							
						array_push($this->arregloElementos,"views*".strpos($cadena, "views"));
					}					
				}
			}
			if(strpos($cadena, "models")){
				
			  if (in_array($cadena, $this->arregloArch)==false) {
				
					if (in_array("models*".strpos($cadena, "models"), $this->arregloElementos)==false) {
							array_push($this->arregloArch,$cadena);
							array_push($this->arregloPosicion,strpos($cadena, "models"));
							
							array_push($this->arregloElementos,"models*".strpos($cadena, "models"));
					}					
				}
			}
			if(strpos($cadena, "controllers")){
				
			  if (in_array($cadena, $this->arregloArch)==false) {
				
				if (in_array("controllers*".strpos($cadena, "controllers"), $this->arregloElementos)==false) {
							array_push($this->arregloArch,$cadena);
							array_push($this->arregloPosicion,strpos($cadena, "controllers"));
							
							array_push($this->arregloElementos,"controllers*".strpos($cadena, "controllers"));
					}					
				}
			}
			$this->recorrerDirectorio($cadena);
		
		}//fin drectoro
	$cadena=$directorio;
	}//fin del if

      }//fin del foreach

  }//fin del meodo

public function compararCarpetas(){
	$contGeneral=0;
	foreach ($this->arregloPosicion as &$numero){
		
		$controlador="controllers*".$numero;
		$vista="views*".$numero;
		$modelos="models*".$numero;
		
		if( in_array($controlador, $this->arregloElementos)==true){
			$this->contadorElementos=$this->contadorElementos+1;
		}
		if( in_array($vista, $this->arregloElementos)==true){
			$this->contadorElementos=$this->contadorElementos+1;
		}
		if( in_array($modelos, $this->arregloElementos)==true){
			$this->contadorElementos=$this->contadorElementos+1;
		}
	
if($this->contadorElementos!=3){
		$conta=0;
		
		foreach ($this->arregloArch as &$dir){
			
				
				if ($conta==$contGeneral){
					
					
					array_push($this->arregloErrores,$dir);
					
				}
			$conta=$conta+1;
		}
 		
		
	}

$this->contadorElementos=0;
$contGeneral=$contGeneral+1;
	}//fin del for
	
}//fin de la funcion
}//end class

?>





