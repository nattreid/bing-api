# Bing Api pro Nette Framework

Nastavení v **config.neon**
```neon
extensions:
    bingApi: NAttreid\BingApi\DI\BingApiExtension

bingApi:
    tagId: 12345
```

Použití
```php
/** @var NAttreid\BingApi\IBingApiFactory @inject */
public $bingApiFactory;

protected function createComponentBingApi() {
    return $this->bingApiFactory->create();
}

public function renderDefault() {
    $this['bingApi']->conversion(500, 'EUR'); // konverze
}
```

v @layout.latte
```latte
<html>
<body>
    <!-- html kod -->
    {control bingApi}
</body>
</html>
```