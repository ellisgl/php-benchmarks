<?php
// vendor\bin\phpbench run benchmarks\RootLevelArrayKeyRenameBench.php --report=aggregate
use PhpBench\Benchmark\Metadata\Annotations\Iterations;
use PhpBench\Benchmark\Metadata\Annotations\Revs;

/**
 * @Revs(100)
 * @Iterations(100)
 */
class RootLevelArrayKeyRenameBench
{
    private $arr = [
        'jack' => ['address_2' => 'London', 'country' => 'UK'],
        'jill' => ['address_2' => 'Washington', 'country' => 'US']
    ];

    private function renameUnordered(array $arr, $oldKey, $newKey): array
    {
        $arr[$newKey] = $arr[$oldKey];

        unset($arr[$oldKey]);
        return $arr;
    }

    private function renameKeyWithLoop(array $arr, $oldKey, $newKey): array
    {
        $newArr = [];

        foreach ($arr as $key => $val)
        {
            if ($oldKey === $key)
            {
                $newArr[$newKey] = $val;
            }
            else
            {
                $newArr[$key] = $val;
            }
        }

        return $newArr;
    }

    private function renameKeyWithJSONStrReplace(array $arr, $oldKey, $newKey): array
    {
        // DANGER: This will change matching sub keys.
        return json_decode(str_replace('"' . $oldKey . '":', '"' . $newKey . '":', json_encode($arr)), true);
    }

    private function renameKeyWithSerializeStrReplace(array $arr, $oldKey, $newKey): array
    {
        // DANGER: This will change matching sub keys.
        return unserialize(str_replace(':"' . $oldKey . '";', ':"' . $newKey . '";', serialize($arr)));
    }

    private function renameKeyWithJSONPregReplace(array $arr, $oldKey, $newKey): array
    {
        // DANGER: This will change matching sub keys, if one isn't found in the root.
        return json_decode(preg_replace('/"' . $oldKey . '":/', '"' . $newKey . '":', json_encode($arr), 1), true);
    }

    private function renameKeyWithSerializePregReplace(array $arr, $oldKey, $newKey): array
    {
        // DANGER: This will change matching sub keys, if one isn't found in the root.
        return unserialize(preg_replace('/:"' . $oldKey . '";/', ':"' . $newKey . '";', serialize($arr), 1));
    }

    private function renameKeyWithArrayKeys(array $arr, $oldKey, $newKey): array
    {
        if (array_key_exists($oldKey, $arr))
        {
            $keys                               = array_keys($arr);
            $keys[array_search($oldKey, $keys)] = $newKey;
            return array_combine($keys, $arr);
        }

        return $arr;
    }

    private function renameKeyWithArrayKeysByReference(array &$arr, $oldKey, $newKey): void
    {
        if (array_key_exists($oldKey, $arr))
        {
            $keys                               = array_keys($arr);
            $keys[array_search($oldKey, $keys)] = $newKey;
            $arr                                = array_combine($keys, $arr);
        }
    }

    // Benchmarks
    public function benchUnordered(): void
    {
        $arr = $this->renameUnordered($this->arr, 'jill', 'john');
    }

    public function benchLoop(): void
    {
        $arr = $this->renameKeyWithLoop($this->arr, 'jill', 'john');
    }

    public function benchJSONStrReplace(): void
    {
        $arr = $this->renameKeyWithJSONStrReplace($this->arr, 'jill', 'john');
    }

    public function benchSerializeStrReplace(): void
    {
        $arr = $this->renameKeyWithSerializeStrReplace($this->arr, 'jill', 'john');
    }

    public function benchJSONPregReplace(): void
    {
        $arr = $this->renameKeyWithJSONPregReplace($this->arr, 'jill', 'john');
    }

    public function benchSerializePregReplace(): void
    {
        $arr = $this->renameKeyWithSerializePregReplace($this->arr, 'jill', 'john');
    }

    public function benchArrayKeys(): void
    {
        $arr = $this->renameKeyWithArrayKeys($this->arr, 'jill', 'john');
    }

    public function benchArrayKeysByReference(): void
    {
        $this->renameKeyWithArrayKeysByReference($this->arr, 'jill', 'john');
    }
}
