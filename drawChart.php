<?php
class drawChart{
	private $data;
	private function openFile($file)
	{
		$handle=@fopen($file,"r");
		if($handle){
			while(($buffer=fgets($handle))!=false)
			{
				$buffer=
			}
		}
		
	}
	function _construct($data){
		$this->data=$data;
	}
}