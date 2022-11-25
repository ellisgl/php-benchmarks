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

    private function renameUnordered(array $arr): array
    {
        $arr['john'] = $arr['jill'];

        unset($arr['jill']);
        return $arr;
    }

    private function renameKeyWithLoop(array $arr): array
    {
        $newArr = [];

        foreach ($arr as $key => $val) {
            if ('jill' === $key) {
                $newArr['john'] = $val;
            } else {
                $newArr[$key] = $val;
            }
        }

        return $newArr;
    }

    private function renameKeyWithJSONStrReplace(array $arr): array
    {// DANGER: This will change matching sub keys.
        return json_decode(str_replace('"' . 'jill' . '":', '"' . 'john' . '":', json_encode($arr)), true);
    }

    private function renameKeyWithSerializeStrReplace(array $arr): array
    {// DANGER: This will change matching sub keys.
        return unserialize(str_replace(':"' . 'jill' . '";', ':"' . 'john' . '";', serialize($arr)));
    }

    private function renameKeyWithJSONPregReplace(array $arr): array
    {// DANGER: This will change matching sub keys, if one isn't found in the root.
        return json_decode(preg_replace('/"' . 'jill' . '":/', '"' . 'john' . '":', json_encode($arr), 1), true);
    }

    private function renameKeyWithSerializePregReplace(array $arr): array
    {// DANGER: This will change matching sub keys, if one isn't found in the root.
        return unserialize(preg_replace('/:"' . 'jill' . '";/', ':"' . 'john' . '";', serialize($arr), 1));
    }

    private function renameKeyWithArrayKeys(array $arr): array
    {
        if (array_key_exists('jill', $arr)) {
            $keys = array_keys($arr);
            $keys[array_search('jill', $keys)] = 'john';
            return array_combine($keys, $arr);
        }

        return $arr;
    }

    private function renameKeyWithArrayKeysByReference(array &$arr): void
    {
        if (array_key_exists('jill', $arr)) {
            $keys = array_keys($arr);
            $keys[array_search('jill', $keys)] = 'john';
            $arr = array_combine($keys, $arr);
        }
    }

    // Benchmarks
    public function benchUnordered()
    {
        $arr = $this->renameUnordered($this->arr);
    }

    public function benchLoop()
    {
        $arr = $this->renameKeyWithLoop($this->arr);
    }

    public function benchJSONStrReplace()
    {
        $arr = $this->renameKeyWithJSONStrReplace($this->arr);
    }

    public function benchSerializeStrReplace()
    {
        $arr = $this->renameKeyWithSerializeStrReplace($this->arr);
    }

    public function benchJSONPregReplace()
    {
        $arr = $this->renameKeyWithJSONPregReplace($this->arr);
    }

    public function benchSerializePregReplace()
    {
        $arr = $this->renameKeyWithSerializePregReplace($this->arr);
    }

    public function benchArrayKeys()
    {
        $arr = $this->renameKeyWithArrayKeys($this->arr);
    }

    public function benchArrayKeysByReference()
    {
        $this->renameKeyWithArrayKeysByReference($this->arr);
    }
}
