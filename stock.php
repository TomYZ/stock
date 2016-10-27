    <?php
        header("Access-Control-Allow-Origin:http://cs-server.usc.edu:3228");
        if(isset($_GET['stock'])!=""){
		$lookup="http://dev.markitondemand.com/MODApis/Api/v2/Quote/json?symbol=".$_GET['stock'];
        
        $json=file_get_contents("$lookup"); //return json file
        echo $json;
        }


        if(isset($_GET['lookup'])!=""){
        $lookup="http://dev.markitondemand.com/MODApis/Api/v2/Lookup/json?input=".$_GET['lookup'];
        
        $json=file_get_contents("$lookup"); //return json file
        echo $json;
    	}	

    	if(isset($_GET['chart'])!=""){
    	$url = 'http://dev.markitondemand.com/MODApis/Api/v2/InteractiveChart/json?parameters={"Normalized":false,"NumberOfDays":1095,"DataPeriod":"Day","Elements":[{"Symbol":"'.$_GET['chart'].'","Type":"price","Params":["ohlc"]}]}';

        $json=file_get_contents("$url"); //return json file
        echo $json;
    	}	


    	if(isset($_GET['news'])!=""){
    	// Replace this value with your account key
                    $accountKey = '3GwXCuVaLBONUeFojkIZ4lr3zpwAjHAr9SenIY+1QqE';
            
                    $ServiceRootURL =  'https://api.datamarket.azure.com/Bing/Search/';
                    
                    $WebSearchURL = $ServiceRootURL . 'News?$format=json&Query=';
                    
                    $context = stream_context_create(array(
                        'http' => array(
                            'request_fulluri' => true,
                            'header'  => "Authorization: Basic " . base64_encode($accountKey . ":" . $accountKey)
                        )
                    ));

                    $request = $WebSearchURL . urlencode( '\'' . $_GET["news"] . '\'');
                    
                   
                    
                    $response = file_get_contents($request, 0, $context);
                    
                    $jsonobj = json_decode($response);
                    
                    
 					date_default_timezone_set('America/Los_Angeles');
                    foreach($jsonobj->d->results as $value)
                    {                        
                        echo('<div class="well"><a href="' . $value->Url . '">'.$value->Title.'</a><br><br>');
                        $d=$value->Description;
                        $s='/'.$_GET["news"].'/g'; 
                        
                        $b="<strong>".$_GET["news"]."</strong>";
                        
                        preg_match($s,$b,$d);
                        echo( $d. '<br><br>');
                        echo('<strong>Publisher: ' . $value->Source. '</strong><br><br>');
                        echo('<strong>Date: ' . date('d M Y H:i:s',strtotime($value->Date)). '</strong><br><br>');
                        echo('</div>');

                    }
     	}
        
    ?>