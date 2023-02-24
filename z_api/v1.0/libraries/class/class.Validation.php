<?php
	class Validation{
		function __construct($d, $func)
	    {
	        $this->d = $d;
	        $this->func = $func;
	    }
	    public function isJSON($string){
		   return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
		}
	    public function storefrontCheckNull($data,array $arraycheck = []){
	    	$errors = [];
	        $errors['error']=false;
	    	if(!$this->isJSON($data)){
	    		$errors['error']=true;
	        	$errors['messenger'] ='Invalid data';
	    	}else{
	    		$data=json_decode($data,true);
		        foreach ($arraycheck as $k) {
		        	if(empty($data[$k])){
		        		$errors['error']=true;
		        		$errors['messenger'] ='Invalid data';
		        		break;
		        	}
		        }
	        }
	        return $errors;
	    }
	    public function storefrontChatSend($data)
	    {
	    	$errors = [];

	    	if (empty($data['message'])) {
	    		$errors[] = 'Nội dung tin nhắn không được trống';
	    	}

	    	return $errors;
	    }

	}
?>