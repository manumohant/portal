<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

 class MetaDataModel extends CI_Model
 {
 	
 	public function __construct()
	{
 		parent::__construct();
 		
 		 $this->load->library('mongo_db');
 	}


 	public function getAllMetaData()
 	{
 		$resultArray = array();
 		$result=$this->mongo_db->db->MetaData->find();
		foreach($result as $data) 
		{
			array_push($resultArray,$data);
		}
		return json_encode($resultArray);

 	}
	public function upsert($metadata)
	{
		$appname =$metadata["appname"];
		$appId =$metadata["appId"];
		$moduleName =$metadata["modules"]["name"];
		$method =$metadata["modules"]["apis"]["method"];
		$desc =$metadata["modules"]["apis"]["desc"];
		$url =$metadata["modules"]["apis"]["url"];
		$req_fields =explode(",",$metadata["modules"]["apis"]["req_fields"]);
		if($appname!='' && $appId!='' && $moduleName!='' && $method!='' && $url!='')
		{
			$searchCond = array('$and'=>array(array("appname"=>$appname),array("appId"=>$appId)));
			$searchData = array('name'=>$moduleName);
			$searchComand = array('$push'=>array('modules'=>$searchData));


			$data = array("method"=>$method,"desc"=>$desc,"access_ctrl_level"=>"admin","req_fields"=>$req_fields,"url"=>$url);
			$condition = array('$and'=>array(array('modules.name'=>$moduleName),array("appname"=>$appname),array("appId"=>$appId)));

			$pushCommand = array('$push'=>array('modules.$.apis'=>$data));
			$upsert = array('upsert'=>true);

			$this->mongo_db->db->MetaData->update(
			   $searchCond,
			   $searchComand,
			   $upsert
			);

			$this->mongo_db->db->MetaData->update(
			   $condition,
			   $pushCommand,
			   $upsert
			);
			return true;
		}
		else
		{
			return false;
		}

	}
 }



// db.MetaData.findAndModify({query: { $and:[{"appname":"jayesh"},{"appId":"2546"}] },
// update:{$push:{"modules":{"name":"jayeshModule3"}}},
// upsert:true
// })



// db.MetaData.findAndModify({query: { $and:[{"modules.name":"jayeshModule3"},{"appname":"jayesh"},{"appId":"2546"}] },
//     update: {$push: {
//        "modules.$.apis": {
// 		"method":"Get","desc":"asdf","access_ctrl_level":"admin","req_fields":["aaa"

//                ],"url":"http://jayesh2.com"
//        }
//      }},
//     upsert: true
// })



