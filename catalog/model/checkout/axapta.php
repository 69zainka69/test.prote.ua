<?php
class ModelCheckoutAxapta extends Model {
	public function addOrder($customer=array(),$order=array()) {
		//$this->log->write($customer);
		//$this->log->write($order);
		//$this->log->write('======= send axapta =======');
		//return $order_id;

		include_once(modification(DIR_SYSTEM . 'library/axapta/axapta.class.php'));
		//$this->log->write('======= send axapta1 =======');



		if(!isset($customer['name'])){$customer['name']='';}
		if(!isset($customer['email'])){$customer['email']='';}
		if(!isset($customer['phone'])){$customer['phone']='';}else{
			$customer['phone'] = str_replace('+38','',$customer['phone']);
		}
		$customer['phone'] = preg_replace("/[ ()-]/", "", $customer['phone']);
		$customer['phone'] = preg_replace( '/^(\d{3})(\d{3})(\d{2})(\d+)$/iu', '($1) $2-$3-$4', $customer['phone'] );

		if(!isset($customer['address'])){$customer['address']='';}
		$CustAccount ='';

		$axapta = new Axapta();

		if ($this->customer->getCustAccount()){
			$CustAccount = $this->customer->getCustAccount();
			//$this->log->write('======= CustAccount =======');
			//$this->log->write($CustAccount);
		} else {
		    $result = $axapta->shopCustInsert($customer['name'],$customer['email'],$customer['phone'],$customer['address']);
		    //$this->log->write('======= shopCustInsert =======');
			//$this->log->write($result);

		    if(isset($result['CustAccount'])){
	            $CustAccount = $result['CustAccount'];
	            if ($customer_id = $this->customer->isLogged()) {
			        $sql = "UPDATE oc_customer SET CustAccount = ".$this->db->escape($result['CustAccount'])." WHERE customer_id='".(int)$customer_id."'";
			        $this->db->query($sql);
		    	}
	        }
	    }
        $comment = '';

	    //if(!isset($order['name'])){$order['name']='';}
	    if(!isset($order['CustPaymMode'])){$order['CustPaymMode']='Уточните способ оплаты';}
	    if(!isset($order['DoNotCallBack'])){$order['DoNotCallBack']='';}
	    if(!isset($order['DeliveryMethod'])){$order['DoNotCallBack']='1';}
	    if(!isset($order['DeliveryRegion'])){$order['DeliveryRegion']='';}
	    if(!isset($order['DeliveryState'])){$order['DeliveryState']='';}
	    if(!isset($order['DeliveryCity'])){$order['DeliveryCity']='';}
	    if(!isset($order['DeliveryNumber'])){$order['DeliveryNumber']='';}
	    if(!isset($order['DeliveryStreet'])){$order['DeliveryStreet']='';}
	    if(!isset($order['DeliveryHouse'])){$order['DeliveryHouse']='';}
	    if(!isset($order['DeliveryFlat'])){$order['DeliveryFlat']='';}
	    if(!isset($order['OrderLines'])){$order['OrderLines']=array();}
	    if(!isset($order['Comment'])){$order['Comment']='';}else {
	    	$comment .= $order['Comment'];
	    }

	    if(isset($result['CustAccount'])){
            $comment .= ' '.$result['Comment'];
        }
        $comment = str_replace("\n"," ",$comment);

        $DeliveryModeRef ='';
        if ($order['DeliveryMethod']==4 && isset($this->session->data['shipping_m']['np_warehouse'])) {
            $this->load->model('d_quickcheckout/address');
            $Warehouse = $this->model_d_quickcheckout_address->getWarehouseById($this->session->data['shipping_m']['np_warehouse']);
            if($Warehouse)$DeliveryModeRef = $Warehouse['np_ref'];
        }
		if ($order['DeliveryMethod']==10 && isset($this->session->data['shipping_m']['just_warehouse'])) {
            $this->load->model('d_quickcheckout/address');
            $Warehouse = $this->model_d_quickcheckout_address->getWarehouseById($this->session->data['shipping_m']['just_warehouse']);
            if($Warehouse)$DeliveryModeRef = $Warehouse['just_ref'];
        }
		if ($order['DeliveryMethod']==11 && isset($this->session->data['shipping_m']['meest_warehouse'])) {
            $this->load->model('d_quickcheckout/address');
            $Warehouse = $this->model_d_quickcheckout_address->getWarehouseById($this->session->data['shipping_m']['meest_warehouse']);
            if($Warehouse)$DeliveryModeRef = $Warehouse['meest_ref'];
        }
		if($order['DeliveryMethod']==10){

			$str = $order['DeliveryCity']." ".$order['DeliveryNumber'];
			$Delive = sha1($str);
		
			$param = array(
				'CustAccount'=> $CustAccount, // код клиента
				'SalesPool'=> 'prote.ua',
				'SalesOrigin'=> 'prote.ua',
				'CustPaymMode'=> $order['CustPaymMode'],
				'DoNotCallBack'=> $order['DoNotCallBack'],
				'DeliveryMethod'=> $order['DeliveryMethod'],
				'DeliveryRegion'=> $order['DeliveryRegion'],
				'DeliveryState'=> $order['DeliveryState'],
				'DeliveryCity'=> $order['DeliveryCity'],
				'DeliveryNumber'=> $order['DeliveryNumber'],
				'DeliveryStreet'=> strip_tags($order['DeliveryStreet']),
				'DeliveryHouse'=> $order['DeliveryHouse'],
				'DeliveryFlat'=> $order['DeliveryFlat'],
				'OrderLines'=> $order['OrderLines'],
				'DeliveryModeRef'=> $Delive,
				'Comment'=> strip_tags($comment),
				'ComplexPaym'=> $order['isComplex'] == '1' ? $order['isComplex'] : '',
			);
		}
		else{
		if($order['DeliveryMethod']==11){

			$str = $order['DeliveryCity']." ".$order['DeliveryNumber'];
			$Delive = sha1($str);
		
			$param = array(
				'CustAccount'=> $CustAccount, // код клиента
				'SalesPool'=> 'prote.ua',
				'SalesOrigin'=> 'prote.ua',
				'CustPaymMode'=> $order['CustPaymMode'],
				'DoNotCallBack'=> $order['DoNotCallBack'],
				'DeliveryMethod'=> $order['DeliveryMethod'],
				'DeliveryRegion'=> $order['DeliveryRegion'],
				'DeliveryState'=> $order['DeliveryState'],
				'DeliveryCity'=> $order['DeliveryCity'],
				'DeliveryNumber'=> $order['DeliveryNumber'],
				'DeliveryStreet'=> strip_tags($order['DeliveryStreet']),
				'DeliveryHouse'=> $order['DeliveryHouse'],
				'DeliveryFlat'=> $order['DeliveryFlat'],
				'OrderLines'=> $order['OrderLines'],
				'DeliveryModeRef'=> $Delive,
				'Comment'=> strip_tags($comment),
				'ComplexPaym'=> $order['isComplex'] == '1' ? $order['isComplex'] : '',
			);
		}
		
		else{

      	$param = array(
	        'CustAccount'=> $CustAccount, // код клиента
	        'SalesPool'=> 'prote.ua',
	        'SalesOrigin'=> 'prote.ua',
	        'CustPaymMode'=> $order['CustPaymMode'],
	        'DoNotCallBack'=> $order['DoNotCallBack'],
	        'DeliveryMethod'=> $order['DeliveryMethod'],
	        'DeliveryRegion'=> $order['DeliveryRegion'],
	        'DeliveryState'=> $order['DeliveryState'],
	        'DeliveryCity'=> $order['DeliveryCity'],
	        'DeliveryNumber'=> $order['DeliveryNumber'],
	        'DeliveryStreet'=> strip_tags($order['DeliveryStreet']),
	        'DeliveryHouse'=> $order['DeliveryHouse'],
	        'DeliveryFlat'=> $order['DeliveryFlat'],
	        'OrderLines'=> $order['OrderLines'],
	        'DeliveryModeRef'=> $DeliveryModeRef,
	        'Comment'=> strip_tags($comment),
            'ComplexPaym'=> $order['isComplex'] == '1' ? $order['isComplex'] : '',
	    );
	}}
	

	    $this->log->write($param);
	    $axapta->createSalesOrderShop($param);
	    //$this->log->write($result);
	}

}
