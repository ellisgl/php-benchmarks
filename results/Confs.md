# Config Benchmark
Test of [geeklab/conf](https://github.com/ellisgl/GeekLab-Conf) (2.0.5)

[Test code](/benchmarks/ConfBench.php)

## Results
AMD Ryzen 1700 - Windows 10

* Revs: 100
* Iterations: 100

PHP 7.2.18 (x64 TS)

OPCache OFF

| benchmark | subject              | mem_peak | best      | mean      | mode      | worst     | stdev    | rstdev | diff  |
|-----------|----------------------|----------|-----------|-----------|-----------|-----------|----------|--------|-------|
| ConfBench | benchGeekLabConfJSON | 950,920b | 485.660μs | 491.073μs | 491.793μs | 505.620μs | 3.629μs  | 0.74%  | 1.00x |
| ConfBench | benchGeekLabConfYAML | 950,920b | 548.710μs | 557.582μs | 558.571μs | 568.240μs | 4.326μs  | 0.78%  | 1.14x |
| ConfBench | benchGeekLabConfINI  | 950,920b | 536.630μs | 547.662μs | 543.735μs | 643.410μs | 14.160μs | 2.59%  | 1.12x |
| ConfBench | benchGeekLabConfArr  | 953,440b | 557.840μs | 570.432μs | 564.635μs | 715.680μs | 21.573μs | 3.78%  | 1.16x |


OPCache ON

| benchmark | subject              | mem_peak | best      | mean      | mode      | worst     | stdev    | rstdev | diff  |
|-----------|----------------------|----------|-----------|-----------|-----------|-----------|----------|--------|-------|
| ConfBench | benchGeekLabConfJSON | 481,624b | 476.990μs | 486.737μs | 484.743μs | 527.780μs | 7.205μs  | 1.48%  | 3.65x |
| ConfBench | benchGeekLabConfYAML | 471,265b | 544.570μs | 552.556μs | 550.325μs | 569.490μs | 4.689μs  | 0.85%  | 4.14x |
| ConfBench | benchGeekLabConfINI  | 471,303b | 532.400μs | 547.005μs | 541.537μs | 649.130μs | 18.118μs | 3.31%  | 4.10x |
| ConfBench | benchGeekLabConfArr  | 469,679b | 129.180μs | 133.523μs | 132.681μs | 145.010μs | 2.356μs  | 1.76%  | 1.00x |


###Take away:
* When OPCache is off, JSON is the fastest, while the PHP array is the slowest and uses the most memory.
* When OPCache is on, Arr is fastest and uses the least amount of memory. The JSON implmentation used the most memory.
* OPCache makes for some super performance improvements for some things and minor for others. 
