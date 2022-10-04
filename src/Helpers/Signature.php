<?php

namespace LaravelSignature\Helpers;

use Illuminate\Http\Request;

class Signature
{
    /**
     * @param string $url
     * @param array $credential ['id' => $your_signature_id, 'key' => $your_signature_key, 'secret' => $your_signature_secret]
     *
     *
     * @return string HMAC-SHA256
     */
    public static function make($url, $credential)
    {
        $path = static::getPath($url);

        $payload = $credential['id'] . ':' . $path . ':' . $credential['key'];
        $hash = hash_hmac('sha256', $payload, $credential['secret']);

        return $hash;
    }

    /**
     * @param Request $request
     * @param string $app one of 'epnbp' or 'kerjasamabu' or 'jasaperbankan'
     * @return boolean
     */
    public static function validate(Request $request, $app)
    {
        $signature = $request->header('signature');
        $credential['id'] = config('signature.' . $app . '.id');
        $credential['key'] = config('signature.' . $app . '.key');
        $credential['secret'] = config('signature.' . $app . '.secret');

        $path = '/' . $request->path();

        $hash = self::make($path, $credential);
        if ($hash === $signature) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param string $url
     *
     * @return string HMAC-SHA256
     */
    public static function epnbp($url)
    {
        $credential['id'] = config('signature.epnbp.id');
        $credential['key'] = config('signature.epnbp.key');
        $credential['secret'] = config('signature.epnbp.secret');

        return self::make($url, $credential);
    }

    /**
     * @param string $url
     *
     * @return string HMAC-SHA256
     */
    public static function jasaperbankan($url)
    {
        $credential['id'] = config('signature.jasaperbankan.id');
        $credential['key'] = config('signature.jasaperbankan.key');
        $credential['secret'] = config('signature.jasaperbankan.secret');

        return self::make($url, $credential);
    }

    /**
     * @param string $url
     *
     * @return string HMAC-SHA256
     */
    public static function kerjasamabu($url)
    {
        $credential['id'] = config('signature.kerjasamabu.id');
        $credential['key'] = config('signature.kerjasamabu.key');
        $credential['secret'] = config('signature.kerjasamabu.secret');

        return self::make($url, $credential);
    }

    /**
     * @param string $url
     *
     * @return string path
     */
    protected static function getPath($url)
    {
        $validURL = parse_url($url, PHP_URL_PATH);
        return $validURL;
    }
}
