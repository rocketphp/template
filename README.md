# template

`RocketPHP\Template` uses static template files. It replaces [@var] tags with PHP variables.

**_To use a template_** – start with an instance of Template and set variables before calling output().

```php
use RocketPHP\Template\Template;

$tpl = new Template('index.tpl');
$tpl->set('title', 'My Page Title');
echo $tpl->output();
```

- File issues at https://github.com/rocketphp/template/issues
- Documentation is at http://rocketphp.io/template
