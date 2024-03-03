> If something is found to be useful, it must change, right?

in our garden example (`EmptyGarden`) you may want to add more functionalities to it, like `plant`, `crop`, `farmer` and so many other things.

```php
interface IGarden {
    public function items();
    public function plant();
    public function water();
    public function crop();
    public function farmer();
    public function fertilize($type, $amount);
    // ...
}
```

> you will notice, this interface grows larger and larger, and the `EmptyGarden` class will implement all these methods, and it will be responsible for all these functionalities.

Always remembers OOP is not just about creating classes and objects, it's about creating classes and objects that are easy to maintain and extend.

let's go back to the `IGarden` interface, and let's say we have a `MarijuanaGarden` class that implements `IGarden` interface.

```php
class MarijuanaGarden implements IGarden {
    public function items() {
        $numberOfSpots = ceil($this->width * $this->height);
        return array_fill(0, $numberOfSpots, "Weed! XD");
    }
    public function plant() {
        // ...
    }
    public function water() {
        // ...
    }
    public function crop() {
        // ...
    }
    public function farmer() {
        // ...
    }
    public function fertilize($type, $amount) {
        // ...
    }
    // ...
}
```

> you will notice, the `MarijuanaGarden` class implements all these methods, and it will be responsible for all these functionalities.

so what is the problem here?

the problem is, the `MarijuanaGarden` class implements all these methods, and it will be responsible for all these functionalities, but the `MarijuanaGarden` class doesn't need all these functionalities, it **only** needs alittle bit of them.

are you need to be forced to implement all these methods? no, you don't need to.

the interface segregation principle states that a class should not be forced to implement an interface that it doesn't use.

so we can break the `IGarden` interface into smaller interfaces, and let the `MarijuanaGarden` class implement the interfaces that it needs.

```php
interface IGarden {
    public function items();
}

interface IPlantable {
    public function plant();
}

interface IWaterable {
    public function water();
}

interface ICropable {
    public function crop();
}

interface IFarmerable {
    public function farmer();
}

interface IFertilizable {
    public function fertilize($type, $amount);
}
```

now the `MarijuanaGarden` class can implement the interfaces that it needs.

```php
class MarijuanaGarden implements IGarden, IPlantable {
    public function items() {
        $numberOfSpots = ceil($this->width * $this->height);
        return array_fill(0, $numberOfSpots, "Weed! XD");
    }
    public function plant() {
        // ...
    }
}
```

> you will notice, the `MarijuanaGarden` class implements only the `IGarden` and `IPlantable` interfaces, and it will be responsible for only these functionalities.
