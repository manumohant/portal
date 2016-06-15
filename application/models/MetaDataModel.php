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
		$mapping =explode(",",$metadata["modules"]["apis"]["mapping"]);
		if($appname!='' && $appId!='' && $moduleName!='' && $method!='' && $url!='')
		{
			

			$data = array("method"=>$method,"desc"=>$desc,"access_ctrl_level"=>"admin","req_fields"=>$req_fields,"url"=>$url,"mapping"=>$mapping);
			$condition = array('$and'=>array(array("appname"=>$appname),array("appId"=>$appId)));
			$setCommand = array('$set'=>array('modules.'.$moduleName.'.apis.'.$desc=>$data));
			$upsert = array('upsert'=>true);

			

			$this->mongo_db->db->MetaData->update(
			   $condition,
			   $setCommand,
			   $upsert
			);
			return true;
		}
		else
		{
			return false;
		}

	}
	public function getAppDetails($appId)
	{
		$condition = array("appId"=>$appId);
		$result =  $this->mongo_db->db->MetaData->find($condition);
		$resultArray = array();
		foreach($result as $data) 
		{
			array_push($resultArray,$data);
		}
		return json_encode($resultArray);
	}
	public function getSingle($desc,$module,$appId)
	{
		$condition = array("modules.".$module.".apis.".$desc=>array('$exists'=>true));
		$result =  $this->mongo_db->db->MetaData->find($condition);
		$resultArray = array();
		foreach($result as $data) 
		{
			array_push($resultArray,$data);
		}
		return json_encode($resultArray);
	}
	public function deleteSingle($desc,$module,$appId)
	{
			$condition = array("appId"=>$appId);
			$setCommand = array('$unset'=>array('modules.'.$module.'.apis.'.$desc=>''));
			

			$this->mongo_db->db->MetaData->update(
			   $condition,
			   $setCommand
			);
		$this->getAppDetails($appId);
	}
 }




// db.MetaData.findAndModify({
//         query: {"appname":"erp","appId":"e2345"} ,
//         update: {
//                $set:{"modules.workorder.apis.get single wo details": 
//                     {"method":"post",
//                      "access_ctrl_level":"admin","req_fields":["aaa"],
//                      "url":"url"}}},
//         upsert: true
// })  