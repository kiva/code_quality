<?php

class Kiva_Sniffs_Functions_DisallowedVariablesSniff implements PHP_CodeSniffer_Sniff {

	public $supportedTokenizers = array('PHP');

	public function register() {
	    return array(T_VARIABLE, T_CONSTANT_ENCAPSED_STRING);
	}

	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr) {
		static $reported = array();

		$all_tokens = $phpcsFile->getTokens();

		if ($all_tokens[$stackPtr]['content'] == '$_COOKIE') {
			$lno = $all_tokens[$stackPtr]['line'];
			if (!isset($reported[$lno])) {
				$reported[$lno] = true;
				$phpcsFile->addError('Accessing $_COOKIE directly is forbidden. Use Bc_Cookie instead.', $stackPtr);
			}
		} else if ($all_tokens[$stackPtr]['content'] == '$_SERVER') {
			if ($all_tokens[$stackPtr+2]['type'] == 'T_CONSTANT_ENCAPSED_STRING'
				&& strstr($all_tokens[$stackPtr+2]['content'], 'REMOTE_ADDR')) {

				$lno = $all_tokens[$stackPtr]['line'];
				if (!isset($reported[$lno])) {
					$reported[$lno] = true;
					$phpcsFile->addError('Accessing $_SERVER[\'REMOTE_ADDR\'] directly is forbidden. Use Bc_DeviceDetect instead.', $stackPtr);
				}
			}
		}
	}
}
