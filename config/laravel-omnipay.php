<?php

return [
    // Cấu hình cho các cổng thanh toán tại hệ thống của bạn, các cổng không xài có thể xóa cho gọn hoặc không điền.
    // Các thông số trên có được khi bạn đăng ký tích hợp.

    'gateways' => [
        'VNPay' => [
            'driver' => 'VNPay',
            'options' => [
                'vnpTmnCode' => '5LI5PRJH',
                'vnpHashSecret' => 'OGMFSVSSHXXGTMLEYUXTJJAYGOSDBCTT',
                'testMode' => true,
            ],
        ],
    ],
];
