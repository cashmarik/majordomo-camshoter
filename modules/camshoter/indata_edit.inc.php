<?php
/*
* @version 0.1 (wizard)
*/

  if ($this->owner->name=='panel') {
   $out['CONTROLPANEL']=1;
  }



//  if ($this->mode=='confirm') 
/*
{
//  $rec=SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");
   $ok=1;
 
   global $arcdate;
if ($arcdate="" ) { $rec['ARCDATE']=date('Ymd');} else 
{   $rec['ARCDATE']=str_replace("-","",$arcdate);}


}
*/
///////////////////////


  $table_name='camshoter_devices';
//  $rec=SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id' and IPADDR='$ipaddr'");


  $rec=SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");
  if ($this->mode=='update') {
//  $rec=SQLSelectOne("SELECT * FROM $table_name WHERE ID='$id'");
   $ok=1;
 
   global $title;
   $rec['TITLE']=$title;

   global $type;
   $rec['TYPE']=$type;

   global $url;
   $rec['URL']=$url;

   global $srok;
   $rec['SROK']=$srok;

   global $sec;
   $rec['SEC']=$sec;


  global $ipaddr;
   $rec['IPADDR']=$ipaddr;



   global $method;
   $rec['METHOD']=$method;

   global $enable;
   $rec['ENABLE']=$enable;

   global $sendtelegram;
   $rec['SENDTELEGRAM']=$sendtelegram;




   global $somebodyignore;
   $rec['SOMEBODYIGNORE']=$somebodyignore;

   global $ffmpegcmd;
   $rec['FFMPEGCMD']=$ffmpegcmd;


   global $users_id;



//   $rec['FFMPEGCMD']=access_user;
debmes('users_id: '.$users_id, 'camshoter');

   $rec['TELEGRAMUSERS']=$users_id;






//ACCESS_USER




  global $linked_object;
  global $linked_property;
  $rec['LINKED_OBJECT']=trim($linked_object);
  $rec['LINKED_PROPERTY']=trim($linked_property);
  addLinkedProperty($rec['LINKED_OBJECT'], $rec['LINKED_PROPERTY'], $this->name);   
   //UPDATING RECORD
//sg('test.merk',$ok);
   if ($ok) {
    if ($rec['ID']) {
     SQLUpdate($table_name, $rec); // update
    } else {
     $new_rec=1;
     $rec['ID']=SQLInsert($table_name, $rec); // adding new record
    }
    $out['OK']=1;


   } else {
    $out['ERR']=1;
   }
  }
   

    else {
    $out['ERR']=1;
   }
  

$sql="select ID,NAME,ADMIN ,(SELECT  count(*)   FROM camshoter_devices   where ID='".$rec['ID']."' and TELEGRAMUSERS  like CONCAT('%',tlg_user.ID,'%' )  )  as ACCESS_USER  from tlg_user ";
debmes($sql, 'camshoter');
//$sql="select ID,NAME,ADMIN ,(SELECT  count(*)   FROM camshoter_devices   where ID='' and  TELEGRAMUSERS=tlg_user.ID )  as ACCESS_USER  from tlg_user ";
$res2 = SQLSelect($sql);
debmes($res2, 'camshoter');
   $out['LIST_ACCESS'] = $res2;


  if (is_array($rec)) {
   foreach($rec as $k=>$v) {
    if (!is_array($v)) {
     $rec[$k]=htmlspecialchars($v);
    }
   



}
  }

  outHash($rec, $out);


