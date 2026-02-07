<?php

class AWeberEntryDataArray implements ArrayAccess, Countable, Iterator  {
    private $counter = 0;

    protected $data;
    protected $keys;
    protected $name;
    protected $parent;

    public function __construct($data, $name, $parent) {
        $this->data = $data;
        $this->keys = array_keys($data);
        $this->name = $name;
        $this->parent = $parent;
    }

    public function count(): int {
        return sizeOf($this->data);
    }

    public function offsetExists(mixed $offset): bool {
        return (isset($this->data[$offset]));
    }

    public function offsetGet(mixed $offset): mixed {
        return $this->data[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value): void {
        $this->data[$offset] = $value;
        $this->parent->{$this->name} = $this->data;
    }

    public function offsetUnset(mixed $offset): void {
        unset($this->data[$offset]);
    }

    public function rewind(): void {
        $this->counter = 0;
    }

    public function current(): mixed {
        return $this->data[$this->key()];
    }

    public function key(): mixed {
        return $this->keys[$this->counter];
    }

    public function next(): void {
        $this->counter++;
    }

    public function valid(): bool {
        if ($this->counter >= sizeOf($this->data)) {
            return false;
        }
        return true;
    }


}
