<?php
class Yii_Sniffs_OtrosSmells_SD44_DuplicateDataBaseConnectionSniff implements PHP_CodeSniffer_Sniff
{
private  $conexionAbierta=false;
private $conexion="";
private  $contador=0;

    /**
     * Returns the token types that this sniff is interested in.
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

       $name = $phpcsFile->getFilename();
       $tokens = $phpcsFile->getTokens();
	if ($tokens[$stackPtr]['content']==='CDbConnection'){
		if($this->contador==0){
			$colon = $phpcsFile->fileNext(array(T_VARIABLE),($stackPtr));
			$this->conexion = $tokens[$colon]['content'];
			$this->conexionAbierta=true;
			$this->contador=+1;
		}else{
			$error = 'more than one connection to a database';
			$data = array(trim($tokens[$stackPtr]['content']));
			$phpcsFile->addError($error, $stackPtr, 'Found', $data);
		}
	  }	
        }//end process()
     }//end class	
?>




