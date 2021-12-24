<?php
class ControllerModuleAxbridge extends Controller {
	public function index() {

	}

  // Save user data into AX
  public function userSave($data) {
     // dummy... while
     //file_put_contents('/var/www/prote.com.ua/ax.txt', 'Axapta userSave is called!'.print_r($data,1)."\n", FILE_APPEND);
  }

  // Save user data into AX
  public function orderSave($data) {
     // dummy... while
     //file_put_contents('/var/www/prote.com.ua/ax.txt', 'Axapta orderSave is called!' . print_r($data,1)."\n", FILE_APPEND);
  }

}