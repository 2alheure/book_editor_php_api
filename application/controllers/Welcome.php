<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$lv_test = explode('/', 'root/2');

		$json = json_decode(file_get_contents(BASEPATH.'../l-art-de-la-guerre.json'), true);
		pr($json, 'json');

		$get = getJSON($json, $lv_test);
		pr($get, 'get');

		$delete = deleteJSON($json, $lv_test);
		pr($delete, 'delete');

		$newOne_test = array(
			'CECI EST UN ARRAY DE TEST'
		);
		$update = updateJSON($json, $lv_test, $newOne_test);
		pr($update, 'update');
	}
}
