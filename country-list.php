<?php 
if(isset($_REQUEST['c_id'])) {
    $country_id = $_REQUEST['c_id'];
}
$data = file_get_contents('country-with-state.json');

$country = json_decode($data); 
if(isset($country_id)){
    $index = getIndex($country_id,$country);
    $state = $country[$index]->get_state_list;
    foreach ($state as $key => $value) {
        unset($value->ms_state_id);
        unset($value->ms_state_code);
        unset($value->ms_status);
    }
    echo json_encode($state);exit();    
}else{
    foreach ($country as $key => $value) {
        unset($value->get_state_list);
        unset($value->mc_country_code_iso3);
        unset($value->mc_status);
        unset($value->mc_country_code);
    }
    echo json_encode($country);
}

function getIndex($name, $array){
    foreach($array as $key => $value){
        if($value->mc_country_id == $name)
              return $key;
    }
    return null;
}
?>
