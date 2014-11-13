<?php
if (class_exists('PHP_CodeSniffer_Standards_AbstractScopeSniff', true) === false) {
	throw new PHP_CodeSniffer_Exception('Class PHP_CodeSniffer_Standards_AbstractScopeSniff not found');
}

/**
 * Kiva_Sniffs_NamingConventions_UnderscoreCapsVariableNameSniff
 */
class Kiva_Sniffs_NamingConventions_UnderscoreCapsVariableNameSniff extends PHP_CodeSniffer_Standards_AbstractVariableSniff {

	protected function processMemberVar(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		$this->_process($phpcsFile, $stackPtr);
	}

	protected function processVariable(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		$this->_process($phpcsFile, $stackPtr);
	}

	protected function processVariableInString(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		$this->_process($phpcsFile, $stackPtr);
	}

	public function _process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		$all_tokens = $phpcsFile->getTokens();

		if (preg_match("/^[a-zA-Z]*[A-Z]+.*/", substr($all_tokens[$stackPtr]['content'],1))) {
			$error = 'Variable name "%s" is not in underscore caps format';
			$data  = array(
			$all_tokens[$stackPtr]['content']
						 );
			$phpcsFile->addError($error, $stackPtr, 'NotUnderscoreCaps', $data);
			return;
		}
	}
}

