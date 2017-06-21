<?php
/**

 *
 * PHP version 5
 *

 */
class Yii_Sniffs_SmellsArquitecturaEnMVC_SA27_DropIndexSniff implements PHP_CodeSniffer_Sniff
{

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
     *
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
        if ($tokens[$stackPtr]['content'] === 'dropIndex') {
           
           //Construye y ejecuta una sentencia SQL para dejar caer un índice.
            
          
               $component="";
            if (strpos($name, "controllers")) {
            

		if (strpos($name, "views")) {
		$component="Views";
		}

		if (strpos($name, "controllers")) {
		$component="Controllers";
		}
		
                 $error ='SQL in '.$component.' -->Builds and executes a SQL statement for dropping an index.; 
                 found %s';
                $data  = array(trim($tokens[$stackPtr]['content']));
                $phpcsFile->addError($error, $stackPtr, 'Found', $data);
                
            }

        }
        
       

    }//end process()


}//end class

?>
