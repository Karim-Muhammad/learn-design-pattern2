# Single Responsibility Principle (SRP)

> #### Separation of Concerns

###### tags: `Design Patterns` `SOLID`

It states the class should have single responsibility, a good practise to follow is to list the responsibilities of the class in comment doc-block. This will help to keep the class focused and avoid it from becoming a "god" class.

```php
/**
* @purpose
*
* Provides empty garden space full of dirt which can
* grow and produce items.
*
*/
class EmptyGarden {
    private float $width;
    private float $height;

    public function __construct(float $width, float $height) {
        $this->width = $width;
        $this->height = $height;
    }

    public function items() {
        $numberOfSpots = ceil($this->width * $this->height);
        return array_fill(0, $numberOfSpots, "Handful of dirt");
    }
}
```

> **Note:** The class `EmptyGarden` has a single responsibility, it provides empty garden space full of dirt which can grow and produce items. The class is not responsible for growing or producing items, it only provides the space for it.

So can we add `harvest()` method to `EmptyGarden` class? No, because it will violate the single responsibility principle. The `harvest()` method should be in a separate class.

> Note: Don't take the single responsibility principle too far. the less changes a class experience, the less all these princinples really matter.

it would take `harvest()` method in `EmptyGarden` class
if the class never changes after it's been written.

this means, it can one class has big responsibilities, but in one condition not changing often.

principles has trade-offs, if it easier to maintain larger class rather than 5 decoupled classes, then it's better to have larger class, and you can encapsulate what varies and keep the rest alone.

---

#### Wikipedia definition:

The single responsibility principle (SRP) is a computer programming principle that states that "A module should be responsible to one, and only one, actor."[1] The term actor refers to a group (consisting of one or more stakeholders or users) that requires a change in the module.

Robert C. Martin, the originator of the term, expresses the principle as, "A class should have only one reason to change".[2] Because of confusion around the word "reason", he later clarified his meaning in a blog post titled "The Single Responsibility Principle", in which he mentioned Separation of Concerns and stated that "Another wording for the Single Responsibility Principle is: Gather together the things that change for the same reasons. Separate those things that change for different reasons."

[src](https://en.wikipedia.org/wiki/Single_responsibility_principle)
