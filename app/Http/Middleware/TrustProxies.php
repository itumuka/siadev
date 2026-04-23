<?php

namespace App\Http\Middleware;

use Fideloper\Proxy\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * Tambahkan '127.0.0.1' karena Nginx di host Anda terhubung ke Docker melalui alamat ini.
     * Tanpa ini, Laravel tidak akan memercayai header dari Nginx.
     *
     * @var array|string|null
     */
    protected $proxies = [
        '127.0.0.1', 
        '10.0.0.0/8', // Tambahkan ini jika Anda menggunakan subnet Docker internal
        '172.16.0.0/12',
        '192.168.0.0/16',
    ];

    /**
     * The headers that should be used to detect proxies.
     *
     * Pastikan HEADER_X_FORWARDED_PROTO ada agar Laravel menggunakan skema HTTPS.
     *
     * @var int
     */
    protected $headers = 
        Request::HEADER_X_FORWARDED_FOR | 
        Request::HEADER_X_FORWARDED_HOST | 
        Request::HEADER_X_FORWARDED_PORT | 
        Request::HEADER_X_FORWARDED_PROTO; // <--- Cukup header ini saja
        
        // Catatan: HEADER_X_FORWARDED_AWS_ELB tidak diperlukan jika Anda hanya menggunakan Nginx host.
}