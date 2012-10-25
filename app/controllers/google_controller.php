<?php
class GoogleController extends AppController {
	var $name = 'Google';
	var $uses = array('GoogleAnalytics.GoogleAnalyticsAccount');
	var $nulayer_id = 8069336;
	
	function index(){
		
		// This finds all of my tracked sites
		$accounts = $this->GoogleAnalyticsAccount->find('all');
		debug($accounts); die();
		// Strip out non-nulayer accounts
		$strippedAccounts = array();
		foreach ($accounts as $account) {
			// echo $account['Account']['accountName'];
			if($account['Account']['accountId'] == $this->nulayer_id && strstr($account['Account']['title'], 'Pressly')){
				$strippedAccounts[] = $account;
			}
		}

		$count = 0;
		foreach ($strippedAccounts as $account) {
				$details = $this->GoogleAnalyticsAccount->find('first',array(
					'conditions'	=> array(
						'tableId'		=> $account['Account']['tableId'],
						'start-date'	=> '2012-01-01',
						'end-date'		=> date('Y-m-d'),
						'metrics'		=> array(
							'newVisits',
							'uniquePageviews',
							'pageviews'
						)
					)
				));
					
				if(isset($details['Account']['dataPoints'][4]['metrics'])){
					foreach ($details['Account']['dataPoints'][4]['metrics'] as $metric) {
						$strippedAccounts[$count]['Account'][$metric['name']] = $metric['value'];
					}
				}
				
				

				
			$count++;
		}

		$this->set('data', $strippedAccounts);
		
			
		
	}
	
	function test(){
		
	}
}
?>