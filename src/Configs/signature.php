<?php

return [
    /**
     * add e-pnbp credential
     * apps : E-PNBP Telekomunikasi && E-PNBP POS
     * @param id
     * @param key
     * @param secret
     */
    'epnbp' => [
        'id' => env('SIGNATURE_EPNBP_ID'),       // your e-pnbp clent id
        'key' => env('SIGNATURE_EPNBP_KEY'),      // your e-pnbp key
        'secret' => env('SIGNATURE_EPNBP_SECRET'),   // your e-pnbp secret
    ],

    /**
     * add Kerjasama Badan Usaha credential
     * apps : Kerjasama Badan Usaha
     * @param id
     * @param key
     * @param secret
     */
    'kerjasamabu' => [
        'id' => env('SIGNATURE_KERJASAMABU_ID'),       // your kerjasama badan usaha clent id
        'key' => env('SIGNATURE_KERJASAMABU_KEY'),      // your kerjasama badan usaha key
        'secret' => env('SIGNATURE_KERJASAMABU_SIGNATURE'),   // your kerjasmaa badan usaha secret
    ],

    /**
     * add jasaperbankan credential
     * apps : Management Kas
     * @param id
     * @param key
     * @param secret
     */
    'jasaperbankan' => [
        'id' => env('SIGNATURE_JASAPERBANKAN_ID'),       // your management kas clent id
        'key' => env('SIGNATURE_JASAPERBANKAN_KEY'),      // your management kas key
        'secret' => env('SIGNATURE_JASAPERBANKAN_SIGNATURE'),   // your management kas secret
    ],

    /**
     * add pendapatanlainlain credential
     * apps : Pendapatan Lain Lain
     * @param id
     * @param key
     * @param secret
     */
    'pendapatanlainlain' => [
        'id' => env('SIGNATURE_PENDAPTANLAINLAIN_ID'),       // your pendapatan lain lain clent id
        'key' => env('SIGNATURE_PENDAPTANLAINLAIN_KEY'),      // your pendapatan lain lain key
        'secret' => env('SIGNATURE_PENDAPTANLAINLAIN_SIGNATURE'),   // your pendaptan lain-lain e-pnbp secret
    ],
];
