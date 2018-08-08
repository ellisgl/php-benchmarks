# Statics vs Non-Static Bench Mark
[Test code](/benchmarks/StaticBench.php)

## Results
AMD Ryzen 1700 - Windows 10 - PHP 7.2.0

| subject        | revs | its | mem_peak | best    | mean    | mode     | worst    | stdev   | rstdev | diff  |
|----------------|------|-----|----------|---------|---------|----------|----------|---------|--------|-------|
| benchStatic    | 100  | 100 | 760,104b | 0.000μs | 5.553μs | 10.058μs | 12.150μs | 5.032μs | 90.61% | 1.00x |
| benchNonStatic | 100  | 100 | 760,104b | 0.000μs | 5.669μs | 10.077μs | 12.290μs | 5.037μs | 88.85% | 1.02x |

