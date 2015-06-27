<?php

class ParlanceContext
{
	function __construct()
	{
	}
	static function instance()
	{
		$context = new ParlanceContext;

		//TODO: user php5 xmlparser
		$xml = & new XmlParser;
		$xml->Parse(PARLANCE_CONFIG_FILE);

		$context->path = $xml->GetNodeByPath("PARLANCE/PARLANCE:PATH")['content'];
		$context->version = $xml->GetNodeByPath("PARLANCE/PARLANCE:VERSION")['content'];

		$nodes = $xml->GetNodeByPath("PARLANCE/PARLANCE:MODULES");
		if(isset($nodes) && ! empty($nodes['child'])) : 
			$context->modules = array();
			foreach($nodes['child'] as $key=>$value) : 
				$module = new stdClass;
				$module->id = $value['content'];
				$module->config = $module->id . '/' . $module->id . '.xml';
				$context->modules[$module->id] = $module;
			endforeach;
		endif;

		$nodes = $xml->GetNodeByPath("PARLANCE/PARLANCE:HOSTS");
		if(isset($nodes) && ! empty($nodes['child'])) :
			$context->hosts = array();
			foreach($nodes['child'] as $key=>$value) :
				$host = new stdClass;
				foreach($value['child'] as $node) :
					 if($node['name'] == 'PARLANCE:HOST:ID') : 
						$host->id = $node['content'];
					 endif;
					 if($node['name'] == 'PARLANCE:HOST:SITE') : 
						$host->site = $node['content'];
					 endif;
					 if($node['name'] == 'PARLANCE:HOST:ROOT') : 
						$host->root = $node['content'];
					 endif;
				endforeach;
			endforeach;

			$context->hosts[$host->id] = $host;
		endif;

		return $context;
	}
}
?>