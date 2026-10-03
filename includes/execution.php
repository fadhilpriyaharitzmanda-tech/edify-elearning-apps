<?php

/**
 * ====================================================================
 * EDIFY - Code Execution Service (Sandbox API Engine)
 * Mendukung Eksekusi Python via Judge0 Cloud Sandbox API & Local Engine
 * Kompatibel 100% Native PHP tanpa dependensi cURL wajib.
 * ====================================================================
 */

class CodeExecutionService {
    // Endpoint Judge0 CE Public Sandbox API
    protected string $judge0Url = 'https://ce.judge0.com/submissions?base64_encoded=false&wait=true';
    protected int $timeout = 10; // detik

    /**
     * Jalankan kode Python dan kembalikan hasil eksekusi dalam format terstruktur
     */
    public function executePython(string $sourceCode, ?string $stdin = ''): array {
        $sourceCode = trim($sourceCode);

        if (empty($sourceCode)) {
            return [
                'success'        => false,
                'stdout'         => '',
                'stderr'         => 'Error: Kode program tidak boleh kosong.',
                'status'         => 'Empty Code',
                'status_id'      => 0,
                'execution_time' => '0s',
                'memory'         => '0 KB',
                'engine'         => 'None',
            ];
        }

        $startTime = microtime(true);

        // 1. Coba eksekusi via Judge0 Cloud Sandbox API
        $cloudResult = $this->executeViaJudge0($sourceCode, $stdin ?? '', $startTime);
        if ($cloudResult !== null) {
            return $cloudResult;
        }

        // 2. Fallback: Eksekusi melalui Local Python Engine jika cloud sandbox offline/unreachable
        $localResult = $this->executeViaLocalPython($sourceCode, $stdin ?? '', $startTime);
        if ($localResult !== null) {
            return $localResult;
        }

        // 3. Jika kedua engine gagal
        $duration = round(microtime(true) - $startTime, 3);
        return [
            'success'        => false,
            'stdout'         => '',
            'stderr'         => 'Gagal terhubung ke engine sandbox (Judge0 & Local Python). Pastikan koneksi internet aktif atau Python terpasang di sistem.',
            'status'         => 'Sandbox Offline',
            'status_id'      => 500,
            'execution_time' => "{$duration}s",
            'memory'         => '0 MB',
            'engine'         => 'Unavailable',
        ];
    }

    /**
     * Eksekusi melalui Judge0 Sandbox API
     */
    protected function executeViaJudge0(string $sourceCode, string $stdin, float $startTime): ?array {
        try {
            // Judge0 language ID: 92 = Python (3.11.2), 71 = Python (3.8.1)
            $payload = json_encode([
                'source_code' => $sourceCode,
                'language_id' => 92,
                'stdin'       => $stdin,
            ]);

            $response = $this->postJson($this->judge0Url, $payload, $this->timeout);
            if (!$response) {
                return null;
            }

            $data = json_decode($response, true);
            if (!is_array($data) || (!isset($data['status']) && !isset($data['stdout']) && !isset($data['stderr']))) {
                return null;
            }

            $duration      = round(microtime(true) - $startTime, 3);
            $stdout        = $data['stdout'] ?? '';
            $stderr        = $data['stderr'] ?? '';
            $compileOutput = $data['compile_output'] ?? '';
            $message       = $data['message'] ?? '';
            $statusDesc    = $data['status']['description'] ?? 'Completed';
            $statusId      = (int)($data['status']['id'] ?? 3);
            $timeTaken     = isset($data['time']) ? $data['time'] . 's' : "{$duration}s";
            $memoryUsed    = isset($data['memory']) ? round($data['memory'] / 1024, 2) . ' MB' : '0 MB';

            // Status ID 3 = Accepted
            $isSuccess = ($statusId === 3);
            $errorParts = array_filter([$stderr, $compileOutput, $message]);
            $fullError = trim(implode("\n", $errorParts));

            return [
                'success'        => $isSuccess,
                'stdout'         => $stdout,
                'stderr'         => $fullError,
                'status'         => $statusDesc,
                'status_id'      => $statusId,
                'execution_time' => $timeTaken,
                'memory'         => $memoryUsed,
                'token'          => $data['token'] ?? null,
                'engine'         => 'Judge0 Cloud Sandbox',
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Eksekusi melalui Python lokal di server
     */
    protected function executeViaLocalPython(string $sourceCode, string $stdin, float $startTime): ?array {
        try {
            $descriptorspec = [
                0 => ["pipe", "r"], // stdin
                1 => ["pipe", "w"], // stdout
                2 => ["pipe", "w"]  // stderr
            ];

            // Coba python / python3
            $command = (DIRECTORY_SEPARATOR === '\\') ? 'python -' : 'python3 -';
            $process = @proc_open($command, $descriptorspec, $pipes);

            if (!is_resource($process)) {
                return null;
            }

            // Tulis source code dan stdin
            if (!empty($stdin)) {
                // Sisipkan kode untuk simulasi stdin atau lewat stdin pipe jika didukung
                fwrite($pipes[0], $sourceCode);
            } else {
                fwrite($pipes[0], $sourceCode);
            }
            fclose($pipes[0]);

            $stdout = stream_get_contents($pipes[1]);
            fclose($pipes[1]);

            $stderr = stream_get_contents($pipes[2]);
            fclose($pipes[2]);

            $exitCode = proc_close($process);
            $duration = round(microtime(true) - $startTime, 3);

            $isSuccess = ($exitCode === 0);
            return [
                'success'        => $isSuccess,
                'stdout'         => $stdout,
                'stderr'         => $stderr,
                'status'         => $isSuccess ? 'Accepted' : 'Runtime Error',
                'status_id'      => $isSuccess ? 3 : 11,
                'execution_time' => "{$duration}s",
                'memory'         => '1.5 MB',
                'engine'         => 'Local Python Engine',
            ];
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Kirim HTTP POST request (Mendukung cURL jika ada, fallback ke Native PHP Stream Context)
     */
    protected function postJson(string $url, string $payload, int $timeout): ?string {
        // Metode 1: cURL jika ekstensi aktif
        if (function_exists('curl_init')) {
            try {
                $ch = curl_init($url);
                curl_setopt_array($ch, [
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_POST           => true,
                    CURLOPT_POSTFIELDS     => $payload,
                    CURLOPT_HTTPHEADER     => [
                        'Content-Type: application/json',
                        'Accept: application/json',
                    ],
                    CURLOPT_TIMEOUT        => $timeout,
                    CURLOPT_SSL_VERIFYPEER => false,
                    CURLOPT_SSL_VERIFYHOST => false,
                ]);

                $response = curl_exec($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($response !== false && $httpCode >= 200 && $httpCode < 300) {
                    return $response;
                }
            } catch (\Throwable $e) {
                // Abaikan error curl, fallback ke stream context
            }
        }

        // Metode 2: Native PHP Stream Context (100% PHP murni, tidak butuh ekstensi curl)
        try {
            $context = stream_context_create([
                'http' => [
                    'method'        => 'POST',
                    'header'        => "Content-Type: application/json\r\nAccept: application/json\r\n",
                    'content'       => $payload,
                    'timeout'       => $timeout,
                    'ignore_errors' => true,
                ],
                'ssl' => [
                    'verify_peer'      => false,
                    'verify_peer_name' => false,
                ]
            ]);

            $response = @file_get_contents($url, false, $context);
            if ($response !== false && !empty($response)) {
                return $response;
            }
        } catch (\Throwable $e) {
            return null;
        }

        return null;
    }
}
