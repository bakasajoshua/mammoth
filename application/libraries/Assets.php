<?php

class Assets
{
	public $css, $js;

	public $javascript_file, $javascript_data;

	public $config;
	function __construct($config = array())
	{
		$this->config = $config;
	}

	function addCss($css_link, $external = FALSE)
	{
		$link = ($external == FALSE) ? $this->config->item('assets_url') . $css_link : $css_link;

		$this->css .="<link rel='stylesheet' href='{$link}' />\n";

		return $this;
	}

	function addJs($js_link, $external = FALSE)
	{
		$link = ($external == FALSE) ? $this->config->item('assets_url') . $js_link : $js_link;

		$this->js .= "<script src = '{$link}'></script>\n";

		return $this;
	}

	function setJavascript($javascript_file, $data = NULL)
	{
		$this->javascript_file = $javascript_file;
		$this->javascript_data = $data;
	}
}