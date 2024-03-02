```php
$garden = new App\MarijuanaGarden(10, 10);
$garden->items();
```

you ask me, why we created `MarijuanaGarden` class? why you didn't pass for example string "Marijuana" to `EmptyGarden` class and let it handle the rest? like do if condition to check if the string is "Marijuana" then return the items, else return the default items.

the answer is, because we want to follow the open/closed principle, in our case we will modify the `EmptyGarden` class when we want to add new **items**, and our principle here says that the class should be open for extension but closed for modification.

so we created `MarijuanaGarden` class to extend `EmptyGarden` class and add new items to it.

```php
class MarijuanaGarden extends EmptyGarden {
    public function items() {
        $numberOfSpots = ceil($this->width * $this->height);
        return array_fill(0, $numberOfSpots, "Weed! XD");
    }
}
```

now we can use `MarijuanaGarden` class to get the items.

```php
$garden = new App\MarijuanaGarden(10, 10);
$garden->items();
```

this is the open/closed principle, we extended the `EmptyGarden` class to add new items to it, without modifying the `EmptyGarden` class.
