# Root Level Array Key Rename Benchmark
Test the different methods of changing an array key name on the root level.

[Test code](/benchmarks/RootLevelArrayKeyRenameBench.php)

## Results
AMD Ryzen 1700 - Windows 10 - PHP 7.2.0

| subject                   | revs | its | mem_peak | best    | mean     | mode     | worst    | stdev   | rstdev  | diff  |
|---------------------------|------|-----|----------|---------|----------|----------|----------|---------|---------|-------|
| benchUnordered            | 100  | 100 | 834,640b | 0.000μs | 4.898μs  | 0.000μs  | 10.140μs | 4.997μs | 102.02% | 1.00x |
| benchLoop                 | 100  | 100 | 834,640b | 0.000μs | 5.384μs  | 9.983μs  | 10.740μs | 4.974μs | 92.38%  | 1.10x |
| benchArrayKeysByReference | 100  | 100 | 834,656b | 0.000μs | 5.754μs  | 9.952μs  | 10.130μs | 4.905μs | 85.24%  | 1.17x |
| benchArrayKeys            | 100  | 100 | 834,640b | 0.000μs | 9.125μs  | 10.003μs | 11.410μs | 2.876μs | 31.52%  | 1.86x |
| benchJSONStrReplace       | 100  | 100 | 834,648b | 7.800μs | 10.167μs | 9.996μs  | 20.000μs | 1.444μs | 14.20%  | 2.08x |
| benchSerializeStrReplace  | 100  | 100 | 834,656b | 7.840μs | 10.269μs | 10.005μs | 20.130μs | 1.621μs | 15.79%  | 2.10x |
| benchJSONPregReplace      | 100  | 100 | 834,648b | 9.870μs | 10.904μs | 10.009μs | 20.020μs | 2.862μs | 26.25%  | 2.23x |
| benchSerializePregReplace | 100  | 100 | 834,656b | 9.860μs | 11.566μs | 10.001μs | 20.140μs | 3.617μs | 31.27%  | 2.36x |
