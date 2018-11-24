# Config Benchmark
Test of geeklab/conf

[Test code](/benchmarks/ConfBench.php)

## Results
AMD Ryzen 1700 - Windows 10 - PHP 7.2.0

* Revs: 100
* Iterations: 100

| subject       | mem_peak | best      | mean      | mode      | worst     | stdev    | rstdev | diff  |
|---------------|----------|-----------|-----------|-----------|-----------|----------|--------|-------|
| benchConfJSON | 787,768b | 529.100μs | 535.753μs | 532.735μs | 548.860μs | 4.395μs  | 0.82%  | 1.00x |
| benchConfYAML | 787,240b | 586.760μs | 598.836μs | 595.435μs | 694.880μs | 15.215μs | 2.54%  | 1.12x |
| benchConfINI  | 787,288b | 592.530μs | 602.118μs | 598.577μs | 716.130μs | 17.531μs | 2.91%  | 1.12x |
| benchConfArr  | 786,912b | 607.050μs | 614.357μs | 612.415μs | 701.590μs | 9.938μs  | 1.62%  | 1.15x |

###Take away:
* GeekLab/Conf/JSON is the fastest by 12-15%, but uses the most memory at peak.
* GeekLab/Conf/Arr uses the least amount of memory by 328 - 856 bytes, but is the slowest in the bunch. 
