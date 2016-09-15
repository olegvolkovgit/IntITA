## Basic usage ##

```php
        $requestParams = $_GET;
        $ngTable = new NgTableAdapter('UserContentManager', $requestParams);
        $result = $ngTable->getData();
        echo json_encode($result);
```
