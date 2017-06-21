<?php

class ComparadorDeListas {
private $arregloInstancias=array();
private $arregloClases=array();
private $arregloErrores=array(); //contiene la ubicación y nombre del archiuo.


  public function __construct($arr1, $arr2) {
        // Access instance variables with $this
        $this->arregloInstancias = $arr2;
	$this->arregloClases = $arr1;

    }



 public function compararClases(){
	foreach ($this->arregloInstancias as &$instancias){
		   $porcionesInstancias = explode("*", $instancias);
		foreach ($this->arregloClases as &$clases) {
			   $porcionesClases = explode("*", $clases);

				if($porcionesClases[0]==$porcionesInstancias[0]){
			
					$this->compararDirectorio($porcionesInstancias[2],$instancias,$porcionesClases[1],$clases);
				}//fin del if
		}
	}
	
  }//end comparar

  private function compararDirectorio($instancia,$instanciaCompleta,$clases,$claseComplea){

	$posicionInstanciaModelo = strstr($instancia, 'models', true);
	$posicionInstanciaVista = strstr($instancia, 'views', true);
	$posicionClasesModelo = strstr($clases, 'models', true);
	$posicionClasesVista = strstr($clases, 'views', true);
	
	if ($posicionInstanciaVista!=false and $posicionClasesModelo!=false ){
	
		if( $posicionInstanciaVista==$posicionClasesModelo){
		
			array_push($this->arregloErrores,$instanciaCompleta."*".$claseComplea);
		}
	}else if ($posicionInstanciaModelo!=false and $posicionClasesVista!=false ){
	
		if( $posicionInstanciaModelo==$posicionClasesVista){

			array_push($this->arregloErrores,$instanciaCompleta."*".$claseComplea);
		}
	}//fin del elseif
 }//fin del comparar Directorio
}//end class

?>
