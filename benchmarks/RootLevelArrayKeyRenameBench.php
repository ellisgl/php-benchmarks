<?php
// vendor\bin\phpbench run benchmarks\RootLevelArrayKeyRenameBench.php --report=aggregate

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

    private function renameUnordered($arr, $oldKey, $newKey)
    {
        $arr[$newKey] = $arr[$oldKey];

        unset($arr[$oldKey]);
        return $arr;
    }

    private function renameKeyWithLoop($arr, $oldKey, $newKey)
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
    public function benchUnordered()
    {
        $arr = $this->renameUnordered($this->arr, 'jill', 'john');
    }

    public function benchLoop()
    {
        $arr = $this->renameKeyWithLoop($this->arr, 'jill', 'john');
    }

    public function benchJSONStrReplace()
    {
        $arr = $this->renameKeyWithJSONStrReplace($this->arr, 'jill', 'john');
    }

    public function benchSerializeStrReplace()
    {
        $arr = $this->renameKeyWithSerializeStrReplace($this->arr, 'jill', 'john');
    }

    public function benchJSONPregReplace()
    {
        $arr = $this->renameKeyWithJSONPregReplace($this->arr, 'jill', 'john');
    }

    public function benchSerializePregReplace()
    {
        $arr = $this->renameKeyWithSerializePregReplace($this->arr, 'jill', 'john');
    }

    public function benchArrayKeys()
    {
        $arr = $this->renameKeyWithArrayKeys($this->arr, 'jill', 'john');
    }

    public function benchArrayKeysByReference()
    {
        $this->renameKeyWithArrayKeysByReference($this->arr, 'jill', 'john');
    }
}