Another simple library to simply control your Hue using PHP models. It just wraps around the API provided by Philips Hue.

# Usage

First create an username for API usage [here](https://www.developers.meethue.com/documentation/getting-started).

Below is an example to instantiate the client.
```php
$client = new \Skeepaars\Hue\Client("http://sample.com", "username");
```

## Lights

How to create the controller:
```php
$lightsController = new \Skeepaars\Hue\LightsController($client);
```

Get all lights connected to your Philips Hue bridge:
```php
$lights = $lightsController->get();
```

Turning on an specific light and set the color to red:
```php

$lightsController->setState(
    1, // Identifier
    255, // Brightness
    new \Skeepaars\Hue\Models\RgbColor(255, 0, 0) // Color
);
```

## Groups

How to create the controller:
```php
$groupsController = new \Skeepaars\Hue\GroupsController($client);
```

Fetching all existing groups on the bridge:
```php
$groups = $groupsController->get();
```

Creating an new group:
```php
$groupIdentifier = $groupController->create(
    "New group",
    \Skeepaars\Hue\Models\Group\Type::ROOM(),
    \Skeepaars\Hue\Models\Group\RoomClass::BEDROOM(),
    [
        1,
        2,
        3
    ]
);
```