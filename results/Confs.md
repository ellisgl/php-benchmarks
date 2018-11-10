# Config Benchmark
Test of geeklab/iniconf vs an array version of it.
[Test code](/benchmarks/ConfBench.php)

## Results
AMD Ryzen 1700 - Windows 10 - PHP 7.2.0

| subject        | revs | its | mem_peak | best      | mean      | mode      | worst     | stdev    | rstdev | diff  |
|----------------|------|-----|----------|-----------|-----------|-----------|-----------|----------|--------|-------|
| benchArrayConf | 100  | 100 | 776,488b | 499.870μs | 510.959μs | 509.948μs | 549.870μs | 8.665μs  | 1.70%  | 1.04x |
| benchINIConf   | 100  | 100 | 777,408b | 479.860μs | 490.404μs | 489.678μs | 530.030μs | 10.476μs | 2.14%  | 1.00x |

I'm actually surprised that the Array didn't come out to be a little bit faster. It did use 920 bytes less memory, but that's absolutly nothing!