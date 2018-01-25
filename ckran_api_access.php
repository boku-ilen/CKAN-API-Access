<?
####### This script grasps data from the open government data portal http://data.gv.at by accessing the provided CKAN 2.6.0 API (https://www.data.gv.at/katalog/api/)
#### The inital use case was to gather data for metadata analysis but can be utilized for any other case dealing with machine-based matadata processing

$ckan_api_url = "https://www.data.gv.at/katalog/api/action/";

### Harvesting the package list
$json_package_list = file_get_contents($ckan_api_url."package_list");
$package_list = json_decode($json_package_list, true);
$package_list_cnt = count($package_list["result"]);
#print_r($package_list["result"]);



####### Due to the usually high amount of data provided by most of the metadatabases the script can stuck or the server blocks the script after a certain running time.
####### The variables $init_data_id places the marker on the starting id of the package_list array; $data_amount defines the number of datasets beeing processed from the starting id
$init_data_id = 100;
$data_amount = 10;

echo "Package_list returns $package_list_cnt datasets";

####


foreach ($package_list["result"] as $key => $var)
	{
	if (($key >=$init_data_id) and ($key <=($init_data_id+$data_amount)))
#	if ($key >$init_data_id)

		{
		echo $key."\n";
		$json_package_show = file_get_contents("https://www.data.gv.at/katalog/api/3/action/package_show?id=$var");		
		$package_show[$key] = json_decode($json_package_show, true);
		}
	}
	
	
##### array for further processing
print_r($package_show);

?>