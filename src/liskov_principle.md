# Liskov Substitution Principle
> en: Objects in a program should be replaceable with instances of their subtypes without altering the  correctness of that program
> ar: يعني ممكن تستبدل كل اي كلاس بـ كلاس مشتق منه او ليهم نفس العيلة بدون ما يتغير السلوك الخاص بالبرنامج 

> Subtypes must be substitutable for their base types.
> A derived class must be able to replace its base class without affecting the behavior of the program.


> en: **Info**: Liskov is a measure of the correctness of a subtyping relationship(inheritance). It is a semantic concept, not a syntactic one. It is about the relationship between objects and their subtypes.

> ar: المبدأ دا نجاحه يدل علي ان العلاقة بين الكلاس والكلاس المشتق منه او الي مرتبط بيه صخيخة لحد الان تبعاً للبرنامج الي بيتعامل معاهم لحد دلوقت 

let's take an example to understand the Liskov Substitution Principle.
let's say we need to classify `Penguin` and `Ostrich` as `Bird` class, because they both have wings but the problem here they cannot fly

and the base class which they inherit from is `Bird` class, and it has `fly()` method.

```php
class Bird {
    public function fly() {
        return "I can fly";
    }
}

class Penguin extends Bird {
    public function fly() {
        return "I can't fly";
    }
}

class Ostrich extends Bird {
    public function fly() {
        return "I can't fly
    }
}
```

the problem here is that `Penguin` and `Ostrich` classes are not substitutable for their base class `Bird` class, because they cannot fly, and the `fly()` method in `Bird` class is not correct for them.
so, here these classes `Penguin` and `Ostrich` have been forced to inherit from `Bird` class, despite the fact that they cannot fly.
(Interface segregation principle can be applied here, to separate the `fly()` method from `Bird` class to another interface, and let `Penguin` and `Ostrich` classes to implement this interface, but this is not the point here)

there are many solutions to solve this problem, one of them is to create `isFly()` method in `Bird` class, and let `Penguin` and `Ostrich` classes to override this method.

```php
class Bird 
{
    public function fly() {
        return "I can fly";
    }
    
    public function isFly() {
        return true;
    }
}

class Penguin extends Bird {
    public function fly() {
        return "I can't fly";
    }
    
    public function isFly() {
        return false;
    }
}

class Ostrich extends Bird {
    public function fly() {
        return "I can't fly";
    }
    
    public function isFly() {
        return false;
    }
}
```

Yes, the problem still exists, but we can alittle say that the `Penguin` and `Ostrich` classes can be used as a substitute for `Bird` class, because they have `isFly()` method to check if they can fly or not.
if true, so they can fly, if false, so they cannot fly.
means we can use these classes in `high-level` classes with help of `isFly()` method to check if they can fly or not.

```php
function canFly(Bird $bird) {
    if ($bird->isFly()) {
        return $bird->fly();
    }
    return "I can't fly";
}
    
$bird = new Bird();
canFly($bird);

$penguin = new Penguin();
canFly($penguin);

$ostrich = new Ostrich();
canFly($ostrich);
```

But still being forced to implement unnecessary methods is not a good solution, but it can works in some cases.
the point of Liskov Substitution Principle is that the `Penguin` and `Ostrich` classes should be able to replace `Bird` class without affecting the behavior of the program, and this is not the case here. (I think)

another solution is to create `Flyable` Interface, and let `Penguin` and `Ostrich` classes to implement this interface.

```php
interface Flyable {
    public function fly();
}

class Bird {
    public function kind() {
        return "I'm a bird";
    }
    
    //   i didn't implement fly() method here
}

class FlyableBird extends Bird implements Flyable {
    public function fly() {
        return
    }
}

class FlightlessBird extends Bird {
    // i didn't implement fly() method here (haven't been forced to implement it)
}

class Penguin extends FlightlessBird {
    public function kind() {
        return "I'm a penguin";
    }
}

class Ostrich extends FlightlessBird {
    public function kind() {
        return "I'm an ostrich";
    }
}
```

these not perfect solution, it just example to arise the problem and show how to solve it using simple design.

another example to understand the Liskov Substitution Principle. (Our `EmptyGarden` class from the Single Responsibility Principle example)

Example:
let's consider our `EmptyGarden` was only accepts width and height as Rectangle Interface, and it has `items()` method to return the items in the garden.
and it was always calculate the area of the garden by multiplying the width and height, and then return the items.
this problem, because `EmptyGarden` is Coupled with `Rectangle` class, and it's not substitutable for `Square` class, because `Square` class has only one side, and it's not the same as `Rectangle` class.

so if we want to create `EmptyGarden` object with `Square` class, we will face issues.

let's see the code
```php
$garden = new App\EmptyGarden(\App\Rectangle(10, 10));
$garden->items(); 

$garden = new App\EmptyGarden(\App\Triangle(60, 60, 60));
$garden->items(); // issues here
// because items() execute this line $numberOfSpots = ceil($this->width * $this->height);
// and it's not correct for Triangle class
// area of the triangle = 1/2 * base * height

$garden = new App\EmptyGarden(\App\Square(10));
$garden->items(); // issues here
// because items() execute this line $numberOfSpots = ceil($this->width * $this->height);
// and it's not correct for Square class
// area of the square = side * side
```

the problem here is that `EmptyGarden` class is not substitutable for `Rectangle` class, because it's not correct for `Square` and `Triangle` classes.

good solution here is to make our `EmptyGarden` class to accept `Area` Interface instead of `RectangleArea`, and `Area` Interface has `area()` method to return the area of the garden.
and every class that implements `Area` Interface should have `area()` method to return the area of the garden.

```php
interface Area {
    public function area(): float;
}

class EmptyGarden {
    private Area $area;
    
    public function __construct(Area $area) {
        $this->area = $area;
    }
    
    public function items() {
        $numberOfSpots = ceil($this->area->area()); // here i code to interface, not to concrete class
        return array_fill(0, $numberOfSpots, "Handful of dirt");
    }
}
```

and we can create `Rectangle` class to implement `Area` Interface.

```php
class Rectangle implements Area {
    private float $width;
    private float $height;
    
    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }
    
    // implementation of Area Interface
    /**
     * @return float
     */
    public function area(): float {
        return $this->width * $this->height;
    }
}
```

now we can use `Rectangle` class to create `EmptyGarden` object.

```php
$garden = new App\EmptyGarden(new App\Rectangle(10, 10));
$garden->items();
```

we can use Triangle class to create `EmptyGarden` object.

```php
class Triangle implements Area {
    private float $base;
    private float $height;
    
    public function __construct(float $base, float $height) {
        $this->base = $base;
        $this->height = $height;
    }
    
    // implementation of Area Interface
    /**
     * @return float
     */
    public function area(): float {
        return 1/2 * $this->base * $this->height;
    }
}

$garden = new App\EmptyGarden(new App\Triangle(60, 60));
$garden->items(); // no issues here, because we code to interface, not to concrete class
```



