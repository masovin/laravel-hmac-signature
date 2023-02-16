# Laravel Signature


## Introduction

Laravel Signature will help you to secure data by identifying who is accessing your end-point with signature

## Requirements

At this time, Laravel Signature only support:
- Laravel ^7.x.
- PHP ^7.3.0

## Installation

1. run `composer require reksakarya/laravel-signature`.

2. add autoload to `composer.json`
```
...
  "autoload": {
    "psr-4": {
      ...
      "LaravelSignature\\": "vandor/reksakarya/laravel-signature/src",
      ...
    }
  }
...
```

3. run command ```composer dump-autoload```

4. add provider to `config/app.php 
```
  "providers" => [
    ...
    /*
    * Package Service Providers...
    */
    LaravelSignature\SignatureServiceProvider::class,
    ...
  ]
```

5. To publish signature config into application, run:

```
$ php artisan vendor:publish --tag=laravel-signature
```

6. next, we need to setup environtment variable on your `.env` :
```
SIGNATURE_EPNBP_ID=
SIGNATURE_EPNBP_KEY=
SIGNATURE_EPNBP_SECRET=
SIGNATURE_KERJASAMABU_ID=
SIGNATURE_KERJASAMABU_KEY=
SIGNATURE_KERJASAMABU_SECRET=
SIGNATURE_JASAPERBANKAN_ID=
SIGNATURE_JASAPERBANKAN_KEY=
SIGNATURE_JASAPERBANKAN_SECRET=
SIGNATURE_PENDAPTANLAINLAIN_ID=
SIGNATURE_PENDAPTANLAINLAIN_KEY=
SIGNATURE_PENDAPTANLAINLAIN_SIGNATURE=
```

7. dont forget to run `php artisan config:cache` to save your config change on cache

then, the installation proccess was complete

## How to use

by default, Reksa Karya Laravel Signature create signature for existing application **E-PNBP Telekomunikasi, E-PNBP POS, Kerjasama Badan Usaha, Management Kas, and Pendapatan Lain Lain**


To create signature, call Signature on your class and you can call static method `Signature::make(string $url, array $credential)` or you can specific on your apps :

> Note! `$credential` variable should be array with value like this:
> ```
> $credentiial = [
>     id: $your-signature-id
>     key: $your-signature-key
>     secret: $your-signature-secret
> ];
> ```

```
<?php
...
use LaravelSignature\Helpers\Signature;
...

class YourPortalController {
  ...
  
  public function getRealisasiPendapatan($year)
  {
      ...
      $url = 'https://ditdal.kominfo.go.id/api/portal-pendapatan/realisasi?tahun='.$year
      $signatureEpnbp = Signature::epnbp($url);
      ...
      
      ...
      $url = 'https://epnbp.baktikominfo.id/api/portal-pendapatan/realisasi?tahun='.$year
      $signatureKerjasamaBU = Signature::kerjasamabu($url);
      ...
      
      ...
      $url = 'https://epnbp.baktikominfo.id/bank/api/portal-pendapatan/realisasi?tahun='.$year
      $signatureJasaPerbankan = Signature::jasaperbankan($url);
      ...

      ...
      $url = 'https://epnbp.baktikominfo.id/pendapatanlainlain/api/portal-pendapatan/realisasi?tahun='.$year
      $signatureJasaPerbankan = Signature::pendapatanlainlain($url);
      ...
  } 
  ...
}
```

if you want to validate that the signature, you can call method `Signature::validate($request, $app);` where param `$app` is string of *'epnbp'* or *'kerjasamabu'* or *'jasaperbankan'* or *'pendapatanlainlain'*. here the example :


```
<?php
...
use Illuminate\Http\Request;
use LaravelSignature\Helpers\Signature;
...

class PortalApiController extends Controller {
  ...
  
  public function getRealisasiPendapatan(Request $request, $year)
  {
      ...
      $isValid = Signature::validate($request, 'epnbp');
      ...
      
      ...
      $isValid = Signature::validate($request, 'kerjasamabu');
      ...
      
      ...
      $isValid = Signature::validate($request, 'jasaperbankan');
      ...

      ...
      $isValid = Signature::validate($request, 'pendapatanlainlain');
      ...
  } 
  ...
}
```

## Implementation on Postman
if you want to test signature by postman, first setup Postman **Pre-request Script** to test api with signature.

first add this variable to environtment : 

| `VARIABLE`                            | `VALUE`                    |
|---------------------------------------|----------------------------|
| SIGNATURE_EPNBP_ID                    | YOUR_EPNBP_ID              |
| SIGNATURE_EPNBP_KEY                   | YOUR_EPNBP_KEY             |
| SIGNATURE_EPNBP_SECRET                | YOUR_EPNBP_SECRET          |
| SIGNATURE_KERJASAMABU_ID              | YOUR_KERJASAMABU_ID        |
| SIGNATURE_KERJASAMABU_KEY             | YOUR_KERJASAMABU_KEY       |
| SIGNATURE_KERJASAMABU_SECRET          | YOUR_KERJASAMABU_SECRET    |
| SIGNATURE_JASAPERBANKAN_ID            | YOUR_JASAPERBANKAN_ID      |
| SIGNATURE_JASAPERBANKAN_KEY           | YOUR_JASAPERBANKAN_KEY     |
| SIGNATURE_JASAPERBANKAN_SECRET        | YOUR_JASAPERBANKAN_SECRET  |
| SIGNATURE_PENDAPTAANLAINLAIN_ID       | YOUR_JASAPERBANKAN_ID      |
| SIGNATURE_PENDAPATANLAINLAIN_KEY      | YOUR_JASAPERBANKAN_KEY     |
| SIGNATURE_PENDAPATANLAINLAIN_SECRET   | YOUR_JASAPERBANKAN_SECRET  |
| signature_payload                     | YOUR_JASAPERBANKAN_SECRET  |
| signature                             | YOUR_JASAPERBANKAN_SECRET  |

next, add this script to every request to `Pre-request Script` to generate signature before sending request : 
```
function getPath(url) {
    var pathRegex = /.+?\:\/\/.+?(\/.+?)(?:#|\?|$)/;
    var result = url.match(pathRegex);
    return result && result.length > 1 ? result[1] : ''; 
}
 
 
function getAuthHeader(httpMethod, requestUrl) {
    var requestPath = getPath(requestUrl);
    
    payload = pm.environment.get('SIGNATURE_EPNBP_ID') + ':' + requestPath + ':' + pm.environment.get('SIGNATURE_EPNBP_KEY');
    postman.setEnvironmentVariable('signature_payload', payload);
    
              
    var hmacSignature = CryptoJS.HmacSHA256(payload, pm.environment.get('SIGNATURE_EPNBP_SECRET'));
    return hmacSignature;
}

postman.setEnvironmentVariable('signature', getAuthHeader(request['method'], request['url']));
```

don't forget to add `signature` key on your **header request** like this : 

| `KEY`                       | `VALUE`                    |
|-----------------------------|----------------------------|
| signature                   | {{signature}}              |
