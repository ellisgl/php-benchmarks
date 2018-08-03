# Loop Bench Mark
Test for, short for, do...while and batch (unfolded) loops.
[Test code](/benchmarks/LoopsBench.php)

## Results
AMD 1700 - Window 10

| subject              | revs | its | mem_peak   | best         | mean         | mode         | worst        | stdev       | rstdev | diff  |
|----------------------|------|-----|------------|--------------|--------------|--------------|--------------|-------------|--------|-------|
| benchStandardForLoop | 10   | 10  | 1,192,112b | 66,103.500μs | 67,223.510μs | 66,540.303μs | 73,303.700μs | 2,049.843μs | 3.05%  | 1.40x |
| benchShortForLoop    | 10   | 10  | 1,192,112b | 63,303.300μs | 63,783.060μs | 63,604.490μs | 65,203.400μs | 513.563μs   | 0.81%  | 1.33x |
| benchDoWhileLoop     | 10   | 10  | 1,192,112b | 63,203.300μs | 63,893.420μs | 63,685.341μs | 64,802.800μs | 461.212μs   | 0.72%  | 1.33x |
| benchBatchLoop       | 10   | 10  | 1,192,104b | 47,802.400μs | 47,962.500μs | 47,878.736μs | 48,302.500μs | 156.123μs   | 0.33%  | 1.00x |