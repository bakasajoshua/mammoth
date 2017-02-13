# EQA Platform
## Installation instruction
1. Add $config["assets_url"]  = $config["base_url"] . 'assets/' in _application/config/config.php_
2. Add your proper database settings in _application/config/database.php_
3. Go to _application/config/autoload.php_ ensure that you have the database library and url helper loaded
4. In _application/config/config.php_ ensure that you set the appropriate base_url.

# How the assets library work
The assets library helps in passing specific assets to specific views. For example, when you have a select2 select box on page A, but you do not need it in page B, then there is no need to pass select2 into page B because it will be of no use in it. Infact, it is a waste of resources.
This library is in _application/libraries_ directory.

## Functions in the library

### 1. addCss
As the name suggests, it helps in passing css into the view.
_usage $this->assets->addCss($stringtoresource, true)_
It takes two parameters
	* css_link(string)
	This is the link where the asset is within the assets folder that you had specified above. It may be internal or extenal.
	* external(boolean)
	_default = false_
	The link may either be within your system or from a CDN. If it is from a cdn ensure you pass true in this 

### 2. addJs
As the name suggests, it helps in passing javascript into the view

### More will come. Still in the early stages of development