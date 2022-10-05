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
     * add Kerjasama BU credential
     * apps : Kerjasama BU
     * @param id
     * @param key
     * @param secret
     */
    'kerjasamabu' => [
        'id' => env('SIGNATURE_KERJASAMABU_ID'),       // your e-pnbp clent id
        'key' => env('SIGNATURE_KERJASAMABU_KEY'),      // your e-pnbp key
        'secret' => env('SIGNATURE_KERJASAMABU_SIGNATURE'),   // your e-pnbp secret
    ],

    /**
     * add e-pnbp credential
     * list : E-PNBP Telekomunikasi && E-PNBP POS
     * @param id
     * @param key
     * @param secret
     */
    'jasaperbankan' => [
        'id' => env('SIGNATURE_JASAPERBANKAN_ID'),       // your e-pnbp clent id
        'key' => env('SIGNATURE_JASAPERBANKAN_KEY'),      // your e-pnbp key
        'secret' => env('SIGNATURE_JASAPERBANKAN_SIGNATURE'),   // your e-pnbp secret
    ],
];
