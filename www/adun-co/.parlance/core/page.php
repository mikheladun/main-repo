<?php

class Page
{
	public $title;
	public $view;
	public $props;
	public $meta;

	function __construct()
	{
		$xml = & new XmlParser;
		$xml->Parse(PARLANCE_WEB_CONFIG_FILE);

		$this->title = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:TITLE")['content']; 

		$this->meta = array();
		$this->meta['description'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:META/META:DESCRIPTION")['content'];
		$this->meta['keywords'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:META/META:KEYWORDS")['content'];
		$this->meta['viewport'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:META/META:VIEWPORT")['content'];
		$this->meta['content-type'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:META/META:CONTENTTYPE")['content'];
		$cache = explode(';',$xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:META/META:CACHE")['content']);
		$this->meta['cache-control'] = $cache[0];
		$this->meta['pragma'] = $cache[0];
		$this->meta['expires'] = $cache[1];

		$this->meta['ogp:title'] = $this->title;
		$this->meta['ogp:type'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:OGP/OGP:TYPE")['content'];
		$this->meta['ogp:site'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:OGP/OGP:SITE")['content'];
		$this->meta['ogp:image'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:OGP/OGP:IMAGE")['content'];
		$this->meta['ogp:description'] = $this->meta['description'];
		$this->meta['ogp:url'] = $xml->GetNodeByPath("PARLANCE/PARLANCE:WEB/WEB:SITE")['content'];
	}

	function view(&$route)
	{
		$context = $route->context;
		$this->view = $route->view;
		$this->props = $route->props;

		// Buffering on
		ob_start();

		try
		{
			if(isset($context->session) && $context->session->active) :
				require_once $context->path . '/web/session.php';
			endif;

			require_once $route->template;
		}
		catch(Exception $e)
		{
			ob_end_clean();
			throw $e;
		}
		// Fetch the output and close the buffer
		$output = ob_get_clean();

		echo $output;
	}
}
?>