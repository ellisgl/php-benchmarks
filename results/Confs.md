# Config Benchmark
Test of geeklab/conf

[Test code](/benchmarks/ConfBench.php)

## Results
AMD Ryzen 1700 - Windows 10 - PHP 7.2.0 - No Caching

* Revs: 100
* Iterations: 100

| benchmark | subject              | mem_peak | best        | mean        | mode        | worst       | stdev    | rstdev | diff  |
|-----------|----------------------|----------|-------------|-------------|-------------|-------------|----------|--------|-------|
| ConfBench | benchGeekLabConfJSON | 864,544b | 1,132.490μs | 1,144.733μs | 1,140.776μs | 1,174.410μs | 8.061μs  | 0.70%  | 1.00x |
| ConfBench | benchGeekLabConfYAML | 864,544b | 1,178.270μs | 1,194.247μs | 1,189.033μs | 1,249.700μs | 11.297μs | 0.95%  | 1.04x |
| ConfBench | benchGeekLabConfINI  | 864,544b | 1,184.350μs | 1,200.843μs | 1,195.178μs | 1,333.900μs | 16.564μs | 1.38%  | 1.05x |
| ConfBench | benchGeekLabConfArr  | 865,808b | 1,207.500μs | 1,221.963μs | 1,216.904μs | 1,321.910μs | 13.785μs | 1.13%  | 1.07x |

###Take away:
* GeekLab/Conf/JSON is the fastest by 12-15%, but uses the most memory at peak.
* GeekLab/Conf/Arr uses the least amount of memory by 328 - 856 bytes, but is the slowest in the bunch. 
